import pandas as pd
from sklearn.externals import joblib
import preprocess as p
import sys

if __name__ == "__main__":
    post = sys.argv[1]
    model = joblib.load('./models/SGD.pkl')
    df = pd.DataFrame()
    df['Post'] = [p.preprocess(post)]
    if len(df['Post'][0]) < 20:
        print -1
    else:
        topic = model.predict(df['Post']);
        category_mapping = pd.read_csv('categories.csv', names=['Category'])
        print category_mapping['Category'][topic].values[0]
