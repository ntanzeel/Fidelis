# Libraries
from scipy import spatial
import mysql.connector as mysql
import random
from collections import Counter
import argparse


def get_default_recommendations(curs):
    curs.execute("SELECT id FROM users")
    return random.sample([x[0] for x in curs.fetchall()], 10)


def get_tag_names(curs):
    curs.execute("SELECT id FROM tags")
    return curs.fetchall()


def generate_count_vector(num_tags):
    return [0] * num_tags


def get_tag_counts(curs, recomendee_id, recommendee_vector, tags, num_posts):
    for idx, tag in enumerate(tags):
        # for tag A, get count of how many posts
        query = (
            "SELECT T.id, count(P.id), P.created_at FROM tags T JOIN post_tag PT ON T.id=PT.tag_id "
            "JOIN posts P ON PT.post_id=P.id WHERE T.id='" + str(
                tag[0]) + "' and P.user_id='" + recomendee_id + "' ORDER BY "
                                                                "P.created_at"
        )
        curs.execute(query)
        posts = curs.fetchall()

        # If the user has made more than N posts, select the N most recent posts made by them
        if len(posts) > num_posts:
            posts = posts[:num_posts]

        # Each element in the user vector will be a tuple containing the tag ID and count for posts made with tag
        recommendee_vector[idx] = (posts[0][0], posts[0][1])

    return recommendee_vector


def get_fof_recommendations(curs, recommendee_id, num_recommendations):
    fof_recommendations = []
    curs.execute("SELECT following_id FROM followers WHERE follower_id='" + recommendee_id + "'")
    followees = [x[0] for x in curs.fetchall()]

    for f in followees:
        curs.execute(
            "SELECT following_id FROM followers WHERE follower_id='" + str(f) + "' AND following_id NOT IN "
                                                                                "('" + recommendee_id + "')"
        )
        fof_recommendations.append([x[0] for x in curs.fetchall()])

    fof_recommendations = [val for sublist in fof_recommendations for val in sublist]
    fof_recommendations = Counter(fof_recommendations).most_common()
    fof_recommendations = [x[0] for x in fof_recommendations]

    if len(fof_recommendations) > num_recommendations:
        return fof_recommendations[:num_recommendations]
    else:
        return fof_recommendations


def get_extended_recommendations(curs, recommendee_id, recommendee_vector, tags, num_posts, num_tags,
                                 num_recommendations):
    extended_recommendations = []
    num_favourites = 5
    threshold = 0.7

    # Sort vector by the count to get the users favourite tags
    recomendee_sorted = sorted(recommendee_vector, key=lambda tup: tup[1])
    favourite_tags = recomendee_sorted[:num_favourites]

    recommendee_vector = [x[1] for x in recommendee_vector]

    # For each tuple, get users posting in that tag, generate their vectors and check cosine similarity
    for tag_tuple in favourite_tags:
        print "Searching for recommendations in {}".format(tag_tuple[0])
        query = (
            "SELECT DISTINCT P.user_id FROM posts P JOIN post_tag PT ON P.id=PT.post_id JOIN tags T ON PT.tag_id=T.id WHERE "
            "T.id='" + str(tag_tuple[0]) + "' AND P.user_id NOT IN ('" + recommendee_id + "')"
        )
        curs.execute(query)
        users = [x[0] for x in curs.fetchall()]

        # Create tag vectors for users in each tag the recomendee has posted in, and check for similarity
        for u in users:
            curs.execute("SELECT name FROM users WHERE id='" + str(u) + "'")
            u_name = curs.fetchone()[0]
            recommendation = get_tag_counts(curs, str(u), generate_count_vector(num_tags), tags, num_posts)
            recommendation = [x[1] for x in recommendation]
            print '{}\'s vector: {}'.format(u_name, recommendation)

            similarity = 1 - spatial.distance.cosine(recommendee_vector, recommendation)
            print "Similarity with {} ({} and {}) is {}\n".format(u_name, recommendee_vector, recommendation,
                                                                  similarity)
            if similarity > threshold:
                extended_recommendations.append(u)

    if len(extended_recommendations) > num_recommendations:
        return random.sample(extended_recommendations, num_recommendations)
    else:
        return extended_recommendations


def get_hybrid_recommendations(curs, recommendee_id, recommendee_vector, tags, num_posts, num_tags,
                               num_recommendations):
    fof_recommendations = set(get_fof_recommendations(curs, recommendee_id, num_recommendations))
    extended_recommendations = set(
        get_extended_recommendations(curs, recommendee_id, recommendee_vector, tags, num_posts,
                                     num_tags, num_recommendations))
    hybrid_recommendations = set.intersection(fof_recommendations, extended_recommendations)

    return list(hybrid_recommendations)


def get_followees(curs, recomendee_id):
    curs.execute("SELECT following_id FROM followers WHERE follower_id='" + recomendee_id + "'")
    return [x[0] for x in curs.fetchall()]


def get_accepted_recommendations(curs, recomendee_id):
    curs.execute("SELECT accepted_id FROM users WHERE id='" + recomendee_id + "'")
    return [x[0] for x in curs.fetchall()]


def get_rejected_recommendations(curs, recomendee_id):
    curs.execute("SELECT rejected_id FROM users WHERE user_id='" + recomendee_id + "'")
    return [x[0] for x in curs.fetchall()]


def get_blocked_users(curs, recomendee_id):
    curs.execute("SELECT blocked_id FROM users WHERE user_id='" + recomendee_id + "'")
    return [x[0] for x in curs.fetchall()]


# In[ ]:

def generate_user_recommendations(curs, user):
    num_recommendations = 10
    num_posts = 100

    # Get tag names and generate user vector that will be used to 
    tags = get_tag_names(curs)
    recommendee_vector = generate_count_vector(len(tags))

    # Get ID of user
    # curs.execute("SELECT id, recommendation_preference FROM users WHERE name='" + user + "'")
    curs.execute("SELECT id FROM users WHERE name='" + user + "'")
    recommendee_id = str(curs.fetchone()[0])
    print 'Making recommendations for user {}\n'.format(recommendee_id)

    # Get counts for the number of posts the user has made for each tag
    recommendee_vector = get_tag_counts(curs, recommendee_id, recommendee_vector, tags, num_posts)

    # Based on user preference, generate user recommendations
    # NOT YET WORKING AS TABLES HAVEN'T BEEN CREATED
    # if preference == 'Friend of a Friend':
    #     recommendations = get_fof_recommendations(curs, recommendee_id, num_recommendations)
    # elif preference == 'General':
    #     recommendations = get_extended_recommendations(curs, user_id, user_vector, tags, num_posts, len(tags))
    # else:
    #     recommendations = hybrid_recommendations(curs, recommendee_id, recommendee_vector, tags, num_posts,
    #                                              num_tags, num_recommendations)

    # Once we have tag counts, look at the users X most popular tags. Get a number
    # of users from each of these, and generate user vectors
    # We will get N users from each of thes
    recommendations = get_extended_recommendations(curs, recommendee_id, recommendee_vector, tags, num_posts, len(tags),
                                                   num_recommendations)
    print 'Recommendations: {}\n'.format(set(recommendations))

    # recommendations = list(set(recommendations) - set(get_accepted_recommendations(curs, recommendee_id)) -
    #                        set(get_rejected_recommendations(curs, recommendee_id)) - set(
    #     get_blocked_users(curs, recommendee_id)) -
    #                        set(get_followees(curs, recommendee_id)))

    # Get a set of recommendations that will be used if we fail to generate "dynamic" recommendations
    if len(recommendations) == 0:
        recommendations = get_default_recommendations(curs)

    # for recommendation in recommendations:
    #     curs.execute("INSERT INTO recommendations VALUES ('" + recommendee_id + "', '" + str(recommendation) + "')")



# Command line parsing for user to 
parser = argparse.ArgumentParser(description='Generate user recommendations for Fidelis')
parser.add_argument('user', action='store', type=str, help='Recommendee')
args = parser.parse_args()

# Establish database connection
conn = mysql.connect(user='root', password='', host='localhost', database='fidelis_recommendations')
curs = conn.cursor()

# Run function to generate user recommendations
generate_user_recommendations(curs, args.user)

# Close connection to database
curs.close()
conn.close()
