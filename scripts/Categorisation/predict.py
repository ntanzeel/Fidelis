import pandas as pd
from sklearn.externals import joblib
import preprocess as p
import sys
import mysql.connector as mysql

if __name__ == "__main__":
    model = joblib.load('./models/SGD.pkl')
    category_mapping = pd.read_csv('categories.csv', names=['Category'])
    if len(sys.argv) == 2:
        post = sys.argv[1]
        df = pd.DataFrame()
        df['Post'] = [p.preprocess(post)]
        if len(df['Post'][0]) < 20:
            print -1
        else:
            topic = model.predict(df['Post']);
            print category_mapping['Category'][topic].values[0]
    else:
        try:
            conn = mysql.connect(user='root', password='password', host='localhost', database='Fidelis', port='3307')
        except Exception, e:
            print e
            exit()

        curs = conn.cursor(buffered=True)

        # Select tags which have not been categorised
        curs.execute("SELECT t.id, t.text FROM tags t LEFT JOIN category_tag pivot ON t.id = pivot.tag_id WHERE pivot.tag_id IS NULL")

        if curs.rowcount > 0:
            tags = pd.DataFrame(curs.fetchall(), columns=['id','tag'])
            # Predict category
            tags['categories'] = category_mapping['Category'][model.predict(tags['tag'])].values[0]

            for row in tags.itertuples():
                # Get ID of predicted category
                curs.execute("SELECT id FROM categories WHERE name=%s LIMIT 1", (row[3],))
                for cat in curs.fetchall():
                    cat = cat[0]
                id = row[1]

                # Add tag to table
                curs.execute(
                    "INSERT INTO category_tag VALUES (NULL, %s, %s, 0, DEFAULT, DEFAULT, DEFAULT)",
                    (int(cat), int(id))
                )
                conn.commit()

        curs.close()
        conn.close()
