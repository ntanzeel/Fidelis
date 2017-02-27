import pandas as pd
from sql import MySQL
from sklearn.externals import joblib


def getClassifier():
    return joblib.load('./models/LogisticRegression.pkl')


def getConnection():
    return MySQL('127.0.0.1', 'root', 'SQLRoot789', 'fidelis')


def getReportedComments(mysql):
    query = ("SELECT reports.id as report_id, comments.id AS comment_id, comments.text as text FROM comments "
             "INNER JOIN reports ON comments.id = reports.comment_id "
             "WHERE reports.processed = FALSE AND reports.deleted_at IS NULL")

    cursor = mysql.get_cursor()
    cursor.execute(query)

    results = []

    for (report_id, comment_id, text) in cursor:
        results.append({'report_id': report_id, 'comment_id': comment_id, 'text': text})

    cursor.close()

    return pd.DataFrame(results) if len(results) > 0 else None


def getScores(comments, classifier):
    predictions = classifier.predict_proba(comments)

    return [prediction[1] * 100 for prediction in predictions]


def updatePredictions(mysql, comments):
    query = ("UPDATE comments SET abuse_score = %s WHERE id = %s")
    cursor = mysql.get_cursor()

    for index, row in comments.iterrows():
        cursor.execute(query, (row['score'], int(round(row['comment_id']))))

    query = ("UPDATE reports SET processed = 1 WHERE id >= %s AND id <= %s")
    cursor.execute(query, (int(min(comments.report_id.values)), int(max(comments.report_id.values))))

    mysql.get_connection().commit()
    cursor.close()


def processReports(mysql, classifier):
    comments = getReportedComments(mysql)

    if comments is not None:
        comments['score'] = getScores(comments.text.values, classifier)
        updatePredictions(mysql, comments)
    else:
        print "No reports to process."


def main():
    # Create a connection to the database.
    classifier = getClassifier()
    mysql = getConnection()

    if mysql.connect():
        processReports(mysql, classifier)
    else:
        print "There was an error connecting to the database. Please check your database configuration and try again."


if __name__ == '__main__':
    main()
