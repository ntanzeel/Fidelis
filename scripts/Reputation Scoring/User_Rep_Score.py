import mysql.connector
import pandas as pd
import numpy as np
import decimal

#connect to database
cnx = mysql.connector.connect(host='127.0.0.1', database='Fidelis', user='root')

#create cursor
cursor = cnx.cursor(buffered=True)

#Get each user's total positive vote rep, negative vote rep and comment rep.
#Returns table in the form: user_id, positive, negative, comment.
query = ("SELECT t1.*, t2.comments, t3.followers, t4.reports FROM (SELECT user_id, SUM(CASE WHEN root = 1 THEN 0.3 ELSE 0.1 END * up_votes) AS positive, SUM(CASE WHEN root = 1 THEN 0.3 ELSE 0.1 END * down_votes) AS negative FROM comments GROUP BY user_id) t1 LEFT JOIN (SELECT p.user_id, COUNT(c.id) * 0.2 comments FROM comments c LEFT JOIN posts p ON c.post_id = p.id WHERE c.user_id != p.user_id GROUP BY p.user_id) t2 ON t1.user_id = t2.user_id LEFT JOIN (SELECT followers.following_id AS user_id, COUNT(DISTINCT followers.follower_id) * 0.5 AS followers FROM followers INNER JOIN (SELECT * FROM followers WHERE approved = 1 ) subq ON followers.follower_id = subq.following_id GROUP BY followers.following_id) t3 ON t1.user_id = t3.user_id LEFT JOIN (SELECT c.user_id AS user_id, COUNT(*) * 0.5 AS reports FROM reports r LEFT JOIN comments c ON c.id = r.comment_id GROUP BY c.user_id) t4 ON t1.user_id = t4.user_id")
cursor.execute(query)

d = pd.DataFrame(np.zeros((cursor.rowcount, 2)))

#for each tuple...
count = 0
for user_id, positive, negative, comments, followers, reports in cursor:
    reputation = positive - negative

    #Make sure 'comments' field is not empty (Only returns number when there is at least one comment)
    if(isinstance(comments, decimal.Decimal)):
        reputation += comments

    #Same again for 'followers' field
    if(isinstance(followers, decimal.Decimal)):
        reputation += followers

    if(isinstance(reports, decimal.Decimal)):
        reputation -= reports

    #update data frame to store reputations
    d.set_value(count, 0, user_id)
    d.set_value(count, 1, reputation)

    count += 1

#get min and max recorded reputation scores, then find difference between them
min_rep = d[1].min()
max_rep = d[1].max()
diff = max_rep - min_rep

#if min = max, all have same reputation score, scale all scores to 0
if(diff == 0):
    d[1] = 0
else:
    #scale between 0 and 100 and update reputation values in database
    d[1] = d[1].apply(lambda x: (x - min_rep)/(diff))

#iterate through each row of dataframe and update users table with new reputation value
for ind, row in d.iterrows():
    add_rep = ("UPDATE users SET reputation = {} WHERE id = {}".format(row[1], row[0]))
    cursor.execute(add_rep)
    cnx.commit()

#close cursor and connection to database
cursor.close()
cnx.close()