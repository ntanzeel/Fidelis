# Libraries
from scipy import spatial
import mysql.connector as mysql
import random
from collections import Counter


def calculate_reputation(curs, comment_id, min_reputation):
        curs.execute(
            "SELECT COUNT(id) FROM votes WHERE comment_id = " + comment_id + " "
            "AND type = 1"
        )

        up_votes = curs.fetchone()[0]

        curs.execute(
            "SELECT COUNT(id) FROM votes WHERE comment_id = " + comment_id + " "
            "AND type = -1"
        )

        down_votes = curs.fetchone()[0]

        return up_votes - down_votes >= min_reputation


# Given the recommendation type, generate default recommendations. For user,
# recommendations default to users with the highest reputation. The same is done
# for posts
def get_default_recommendations(curs, recomendee_id, recommendation_type, min_reputation, num_recommendations):
    default_recommendations = []

    if recommendation_type == 0:
        curs.execute(
            "SELECT PT.tag_id, C.id FROM comments C JOIN posts P ON C.post_id = "
            "P.id JOIN post_tag PT ON P.id = PT.post_id WHERE C.user_id != "
            + recomendee_id + ""
        )
        comments = curs.fetchall()

        for comment in comments:
            if calculate_reputation(curs, str(comment[1]), min_reputation):
                default_recommendations.append(comment)
    else:
        curs.execute(
            "SELECT id, reputation FROM users WHERE reputation >= "
            + str(min_reputation) + " AND id != " + recomendee_id + " "
            "ORDER BY reputation DESC"
        )

        default_recommendations = [(-1, x[0]) for x in curs.fetchall()]

    return default_recommendations[:num_recommendations]


# Get the total number of tags being used on Fidelis
def get_tags(curs):
    curs.execute("SELECT id FROM tags")
    return [x[0] for x in curs.fetchall()]


# Generate a count vector that will be used for user similarity
def generate_count_vector(num_tags):
    return [0] * num_tags


# Populate the count vector by counting the number of posts/votes a user has made
# in each of the tags. Return a vector of tuples, where each tuple is a tag ID-count
# pair
def get_tag_counts(curs, recommendation_type, recomendee_id, num_tags, tags):
    recomendee_vector =  [0] * num_tags

    for idx, tag in enumerate(tags):
        # Content recommendation
        if recommendation_type == 0:
            curs.execute(
                "SELECT T.id, count(P.id), P.created_at FROM tags T JOIN "
                "post_tag PT ON T.id = PT.tag_id JOIN posts P ON PT.post_id = P.id "
                "WHERE T.id =" + str(tag) + " and P.user_id =" + recomendee_id + ""
                " ORDER BY P.created_at"
            )
            counts = curs.fetchall()
        # User recommendation
        else:
            curs.execute(
                "SELECT T.id, count(V.id), V.created_at FROM tags T JOIN "
                "post_tag PT ON T.id = PT.tag_id JOIN posts P on PT.post_id = P.id "
                "JOIN comments C on P.id = C.post_id JOIN votes V on C.id = V.comment_id "
                "WHERE T.id = " + str(tag) + " AND V.user_id = " + recomendee_id + " "
                "AND V.type = 1 ORDER BY V.created_at"
            )
            counts = curs.fetchall()

        # Each element in the user vector will be a tuple containing the tag ID and count for posts made with tag
        recomendee_vector[idx] = (counts[0][0], counts[0][1])

    return recomendee_vector


# Generate friend-of-a-friend recommendations by looking at all the users followed
# by the followees of the recomendee. Use these users to either provide user recommendations,
# or get the content they post to provide content recommendation
def get_fof_recommendations(curs, recommendation_type, recomendee_id, num_recommendations, min_reputation):
    fof_recommendations = []

    curs.execute(
        "SELECT following_id FROM followers WHERE follower_id = " + recomendee_id + " "
        "AND following_id != " + recomendee_id + ""
    )
    recomendee_followees = [x[0] for x in curs.fetchall()]

    for f in recomendee_followees:
        # Get followees followees
        curs.execute(
            "SELECT following_id FROM followers WHERE follower_id = " + str(f) + " "
            "AND following_id != " + recomendee_id + ""
        )
        fofs = [x[0] for x in curs.fetchall()]

        if not set(fofs).issubset(recomendee_followees):
            # Append recommendations as (Tag ID, recommendation). FOF doesn't user_id
            # tags to generate recommendtions so set ID to -1
            fof_recommendations.append([x[0] for x in fofs])

    # fof_recommendations is currently a list of lists, so flatten it to get
    # a single list
    fof_recommendations = [val for sublist in fof_recommendations for val in sublist]

    if recommendation_type == 0:
        candidate_posts = []
        fof_recommendations = list(set(fof_recommendations))

        for user in fof_recommendations:
            curs.execute(
                "SELECT T.id, C.id FROM comments C JOIN posts P ON C.post_id = "
                "P.id JOIN post_tag PT ON P.id = PT.post_id JOIN tags T ON "
                "PT.tag_id = T.id WHERE C.user_id = " + str(user) + " AND C.root = 1"
            )
            comments = curs.fetchall()

            for comment in comments:
                if calculate_reputation(curs, str(comment[1]), min_reputation):
                    candidate_posts.append(comment)

        fof_recommendations = candidate_posts
    else:
        fof_recommendations = Counter(fof_recommendations).most_common()
        fof_recommendations = [(-1, x[0]) for x in fof_recommendations]

    # Only return the number of recommendations required
    if len(fof_recommendations) > num_recommendations:
        return fof_recommendations[:num_recommendations]
    else:
        return fof_recommendations


# Generate 'explorer' recommendations by using a recomendees tag count vector.
# Search for potential recommendations in the tags where the user has posted
# or voted the most, and build vectors for users in these tags for comparison.
# For user recommendations, use cosine similarity to determine whether a recommendation
# is used, and for content recommendation use the content's reputation
def get_explorer_recommendations(curs, recommendation_type, recomendee_id, recomendee_vector, threshold, min_reputation, tags, num_tags, num_recommendations):
    explorer_recommendations = []
    num_favourites = 5

    # Sort vector by the count to get the users favourite tags
    recomendee_sorted = sorted(recomendee_vector, key=lambda tup: tup[1], reverse=True)

    # Select the IDs of the users most popular tags
    favourite_tags = [x[0] for x in recomendee_sorted[:num_favourites] if x[1] > 0]
    recomendee_vector = [x[1] for x in recomendee_vector]

    # For each tag, get users posting in it and generate their vectors and check
    # cosine similarity
    for tag in favourite_tags:
        curs.execute("SELECT text FROM tags WHERE id = " + str(tag) + "")
        tag_name = curs.fetchone()[0]
        curs.execute(
            "SELECT DISTINCT P.user_id FROM posts P JOIN post_tag PT ON "
            "P.id = PT.post_id JOIN tags T ON PT.tag_id = T.id WHERE T.id = "
            + str(tag) + " AND P.user_id != " + recomendee_id + ""
        )
        users = [x[0] for x in curs.fetchall()]

        # Create tag vectors for users in each tag the recomendee has posted in, and check for similarity
        for u in users:
            if recommendation_type == 0:
                curs.execute(
                    "SELECT C.id FROM tags T join post_tag PT "
                    "ON T.id = PT.tag_id JOIN posts P on PT.post_id = P.id JOIN "
                    "comments C on P.id = C.post_id WHERE C.user_id = "
                    + str(u) + " AND C.root = 1 AND T.id = " + str(tag) + " "
                )

                comments = [x[0] for x in curs.fetchall()]
                curs.execute("SELECT name FROM users WHERE id = " + str(u) + "")
                name = curs.fetchone()[0]

                curs.execute("SELECT text FROM tags WHERE id = " + str(tag) + "")
                t_name = curs.fetchone()[0]

                for comment in comments:
                    if calculate_reputation(curs, str(comment), min_reputation):
                        explorer_recommendations.append((tag, comment))
            else:
                # Perform cosine similarity between recomendees tag count vector
                # and potential recommendations' vector
                recommendation_vector = get_tag_counts(curs, recommendation_type, str(u), num_tags, tags)
                recommendation_vector = [x[1] for x in recommendation_vector]

                if all(v == 0 for v in recomendee_vector) or all(v == 0 for v in recommendation_vector):
                    similarity = 0
                else:
                    similarity = 1 - spatial.distance.cosine(recomendee_vector, recommendation_vector)

                if similarity > threshold:
                    explorer_recommendations.append((tag, u))

    # Only return the number of recommendations required
    if len(explorer_recommendations) > num_recommendations:
        return random.sample(explorer_recommendations, num_recommendations)
    else:
        return explorer_recommendations


# Generate 'hybrid' recommendations by taking the intersect of the results from fof
# and explorer recommendations
def get_hybrid_recommendations(curs, recommendation_type, recomendee_id, recomendee_vector, num_recommendations, min_reputation, threshold,tags, num_tags):
    fof_recommendations = set(get_fof_recommendations(curs, recommendation_type, recomendee_id, num_recommendations, min_reputation))

    explorer_recommendations = set(get_explorer_recommendations(curs, recommendation_type, recomendee_id, recomendee_vector, threshold,
                                    min_reputation, tags, num_tags, num_recommendations))

    hybrid_recommendations = set.intersection(fof_recommendations, explorer_recommendations)

    return list(hybrid_recommendations)


# Get the followees for a specific user
def get_followees(curs, recomendee_id):
    curs.execute(
        "SELECT following_id FROM followers WHERE "
        "follower_id = "+ recomendee_id + ""
    )
    return [(-1, x[0]) for x in curs.fetchall()]


# Get resolved (accepted/rejected) recommendations for a specific user
def get_resolved_recommendations(curs, recommendation_type, recomendee_id):
    if recommendation_type == 0:
        curs.execute(
            "SELECT tag_id, content_recommendation FROM content_recommendations WHERE "
            "user_id = " + recomendee_id + " AND (response = 1 OR response = -1)"
        )
    else:
        curs.execute(
            "SELECT tag_id, user_recommendation FROM user_recommendations WHERE user_id "
            "= " + recomendee_id + " AND (response = 1 OR response = -1)"
        )
    return curs.fetchall()


# Get blocked users for a specific user
def get_blocked_users(curs, recomendee_id):
    curs.execute(
        "SELECT blocked_id FROM blocked WHERE blocker_id=" + recomendee_id + ""
    )
    return [(-1, x[0]) for x in curs.fetchall()]


# Create a set of user and content recommendations for a given user by using their preferred
# recommendation technique
def generate_recommendations(curs, recomendee_id, recommendation_type, preference, num_recommendations, similarity_threshold, min_reputation):
    recommendations = []

    # Get tag names and generate user vector that will be used to
    print "Preparing tag count vector........."
    tags = get_tags(curs)
    num_tags = len(tags)
    recomendee_vector = get_tag_counts(curs, recommendation_type, str(recomendee_id), num_tags, tags)

    if preference == 'FOF':
        print "Generating FOF Recommendations........."
        recommendations = get_fof_recommendations(curs, recommendation_type, recomendee_id, num_recommendations, min_reputation)

        print "FOF Recommendations: {}".format(recommendations)
    elif preference == 'Explorer':
        print "Generating Explorer Recommendations........."
        recommendations = get_explorer_recommendations(curs, recommendation_type, recomendee_id,
        recomendee_vector, similarity_threshold, min_reputation, tags, num_tags, num_recommendations)

        print "Explorer Recommendations: {}".format(recommendations)
    elif preference == 'Hybrid':
        print "Generating Hybrid Recommendations........."
        recommendations = get_hybrid_recommendations(curs, recommendation_type, recomendee_id,
        recomendee_vector, num_recommendations, min_reputation, similarity_threshold, tags, num_tags)

        print "Hybrid Recommendations: {}".format(recommendations)

    # Get a set of recommendations that will be used if we fail to generate "dynamic" recommendations
    if len(recommendations) == 0:
        print "No recommendations made........reverting to default recommendations......."
        recommendations = get_default_recommendations(curs, recomendee_id, recommendation_type, min_reputation, num_recommendations)

    print "Removing unwanted recommendations........."
    recommendations = list(set(recommendations) -
    set(get_resolved_recommendations(curs, recommendation_type, recomendee_id))
    - set(get_blocked_users(curs, recomendee_id))
    - set(get_followees(curs, recomendee_id)) - set(recomendee_id))

    print "Recommendations for user are {}".format(recommendations)

    print "Adding new recommendations to database.........\n"
    # Insert newly created recommendations into the database
    for r in recommendations:
        # Adding new content recommendations
        if recommendation_type == 0 and r[0] == -1:
            curs.execute(
                "INSERT INTO content_recommendations VALUES (Null, %s, %s, Null, %s, DEFAULT, DEFAULT, DEFAULT)",
                (recomendee_id, r[1], 0)
            )
        elif recommendation_type == 0 and r[0] != -1:
            curs.execute(
                "INSERT INTO content_recommendations VALUES (Null, %s, %s, %s, %s, DEFAULT, DEFAULT, DEFAULT)",
                (recomendee_id, r[1], r[0], 0)
            )
        # Adding new user recommendations
        elif recommendation_type == 1 and r[0] == -1:
            curs.execute(
                "INSERT INTO user_recommendations VALUES (Null, %s, %s, Null, %s, DEFAULT, DEFAULT, DEFAULT)",
                (recomendee_id, r[1], 0)
            )
        else:
            curs.execute(
                "INSERT INTO user_recommendations VALUES (Null, %s, %s, %s, %s, DEFAULT, DEFAULT, DEFAULT)",
                (recomendee_id, r[1], r[0], 0)
            )
    conn.commit()


# Establish database connection
print "Connecting to database........."
conn = mysql.connect(user='root', password='', host='localhost', database='fidelis')
curs = conn.cursor()

curs.execute("SELECT id FROM users")
fidelis_users = [x[0] for x in curs.fetchall()]

for user in fidelis_users:
    user = str(user)

    curs.execute(
        "SELECT settings.id AS id, (CASE WHEN settings.user_id IS NULL THEN {} "
        "ELSE settings.user_id END) AS user_id, default_settings.name AS name, "
        "(CASE WHEN settings.value IS NULL THEN default_settings.value ELSE "
        "settings.value END) AS value FROM default_settings LEFT JOIN (SELECT "
        "* FROM settings WHERE user_id = {} AND settings.user_id IS NOT NULL AND "
        "settings.deleted_at IS NULL) settings ON default_settings.name = "
        "settings.name WHERE default_settings.deleted_at IS NULL".format(user, user)
    )
    settings = curs.fetchall()

    # Get all relevant user settings
    for setting in settings:
        if setting[2] == 'recommendation_preference':
            preference = str(setting[3])
        elif setting[2] == 'recommendation_number':
            num_recommendations = int(setting[3])
        elif setting[2] == 'recommendation_threshold':
            similarity_threshold = float(setting[3])
        elif setting[2] == 'recommendation_reputation':
            min_reputation = int(setting[3])

    curs.execute(
        "SELECT count(id) FROM content_recommendations WHERE user_id=" + user + " "
        "AND response=0"
    )
    remaining_content = curs.fetchone()[0]

    curs.execute(
        "SELECT count(id) FROM user_recommendations WHERE user_id=" + user + " "
        "AND response=0"
    )
    remaining_users = curs.fetchone()[0]

    curs.execute("SELECT name FROM users WHERE id="+user+"")
    name = curs.fetchone()[0]

    if remaining_content < num_recommendations:
        print "Generating content recommendations for {}............".format(name)
        generate_recommendations(curs, user, 0, preference, num_recommendations - remaining_content,
        similarity_threshold, min_reputation)

    if remaining_users < num_recommendations:
        print "Generating user recommendations for {}............".format(name)
        generate_recommendations(curs, user, 1, preference, num_recommendations - remaining_users,
        similarity_threshold, min_reputation)

# Close connection to database
curs.close()
conn.close()
