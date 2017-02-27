import mysql.connector

#connect to database
cnx = mysql.connector.connect(host='127.0.0.1', database='Fidelis', user='root')

#create cursor
cursor = cnx.cursor(buffered=True)

#get all user IDs
query = ("SELECT id FROM users")
cursor.execute(query)

#'user' is a singlet tuple containing the id of a given user.
#so for each user...
for user in cursor:
    #This user's initial reputation score
    reputation = 0

    #create second cursor
    cursor2 = cnx.cursor(buffered=True)

    #get all post IDs associated with this user
    query = ("SELECT id FROM posts WHERE user_id = {}".format(user[0]))
    cursor2.execute(query)

    #for each post
    for post in cursor2:
        #create third cursor
        cursor3 = cnx.cursor(buffered=True)

        #get count of up votes on this post
        query = ("SELECT COUNT(id) FROM votes WHERE type = 'up' AND comment_id = {}".format(post[0]))
        cursor3.execute(query)

        #add weighted count to reputation score
        for count in cursor3:
            reputation += (0.3 * count[0])

        #get count of down votes
        query = ("SELECT COUNT(id) FROM votes WHERE type = 'down' AND comment_id = {}".format(post[0]))
        cursor3.execute(query)

        #subtract weighted count to repuration score
        for count in cursor3:
            reputation -= (0.3 * count[0])

        #get count of comments on this post which were not made by this user
        query = ("SELECT COUNT(id) FROM comments WHERE post_id = {} AND user_id != {}".format(post[0], user[0]))
        cursor3.execute(query)

        #add weighted count to reputation score
        for count in cursor3:
            reputation += (0.2 * count[0])

        #close cursor3
        cursor3.close()

    #get all comments from this user (which are not root)
    query = ("SELECT id FROM comments WHERE root = false AND user_id = {}".format(user[0]))
    cursor2.execute(query)

    #for each comment
    for comment in cursor2:
        #create third cursor
        cursor3 = cnx.cursor(buffered=True)

        #get count of up votes on this comment
        query = ("SELECT COUNT(id) FROM votes WHERE type = 'up' AND comment_id = {}".format(comment[0]))
        cursor3.execute(query)

        #add weighted count to reputation score
        for count in cursor3:
            reputation += (0.1 * count[0])

        #get count of down votes
        query = ("SELECT COUNT(id) FROM votes WHERE type = 'down' AND comment_id = {}".format(comment[0]))
        cursor3.execute(query)

        #subtract weighted count to repuration score
        for count in cursor3:
            reputation -= (0.1 * count[0])

        #close cursor3
        cursor3.close()

    #query for updating reputation of user
    add_rep = ("UPDATE users SET reputation = {} WHERE id = {}".format(reputation, user[0]))
    cursor2.execute(add_rep)
    cnx.commit()

    if user[0] == 3:
            print(reputation)

    #close cursor2
    cursor2.close()

#get all user IDs
query = ("SELECT id, reputation FROM users")
cursor.execute(query)
for id, rep in cursor:
    print(id, rep)

#close cursor and connection to database
cursor.close()
cnx.close()
print("done")

#currently reputations are stored as integers, so will be rounded: Shouldn't really be too much of an issue in a system
#with lots of users and lots of interaction (since reputation values will be high enough that rounding is negligable)

#Should positive votes have stronger weighting than negative to stop trolls from 'neg-bombing'?

#Wanted to only update rep score with new votes/comments, but issues with people changing votes/deleting comments etc.
#would have to change other parts of platform. But then should deleted comments count towards reputation or not?
#Therefore just made it recalculate each user's score each time the program runs for the moment.