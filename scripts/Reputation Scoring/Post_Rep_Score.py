import numpy as np
import decimal

#connect to database
cnx = mysql.connector.connect(host='127.0.0.1', database='Fidelis', user='root')

#create cursor
cursor = cnx.cursor(buffered=True)

#Get each user's total positive vote rep, negative vote rep and comment rep.
#Returns table in the form: user_id, positive, negative, comment.
query = ("SELECT post_id, ((COUNT(post_id) - 1) * 0.2) AS comments, (up_votes * 0.1) AS positive, (down_votes * 0.1) AS negative FROM comments GROUP BY post_id")
cursor.execute(query)

d = pd.DataFrame(np.zeros((cursor.rowcount, 2)))

#for each tuple...
count = 0
for post_id, comments, positive, negative in cursor:
    reputation = positive - negative

    #Make sure 'comments' field is not empty (Only returns number when there is at least one comment)
    if(isinstance(comments, decimal.Decimal)):
        reputation += comments

    #update data frame to store reputations
    d.set_value(count, 0, post_id)
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
    add_rep = ("UPDATE posts SET reputation = {} WHERE id = {}".format(row[1], row[0]))
    cursor.execute(add_rep)
    cnx.commit()

#close cursor and connection to database
cursor.close()
cnx.close()