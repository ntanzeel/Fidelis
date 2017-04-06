import preprocess as pre
import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import GaussianNB
from sklearn.linear_model import LogisticRegression
from sklearn.svm import SVC
from sklearn.externals import joblib

if __name__ == "__main__":
    dataframe = pd.read_csv('dataset.csv', sep=',', header=None)
    text = dataframe[0]
    category = dataframe[1]
    vectorizer = CountVectorizer(preprocessor=pre.preprocess)
    X = vectorizer.fit_transform(text)
    df = pd.DataFrame(data=X)

    # naiveBayes = GaussianNB()
    # model = naiveBayes.fit(X, category)
    # joblib.dump(model, 'models/NaiveBayes.pkl')

    print(df)
