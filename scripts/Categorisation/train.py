# Data Structures
import numpy as np
import pandas as pd

# Preprocessing
import preprocess as p

# Feature Engineering
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.feature_extraction.text import TfidfTransformer
from sklearn.feature_selection import SelectPercentile, chi2

# Models
from sklearn.naive_bayes import MultinomialNB
from sklearn.linear_model import SGDClassifier
from sklearn.svm import SVC

# Pipeline
from sklearn.pipeline import Pipeline

# Exporting
from sklearn.externals import joblib

# CV
from sklearn.model_selection import cross_val_score

if __name__ == '__main__':
    data = pd.read_csv('data/dataset.csv', header=None, names=['Post', 'Category']) # Load dataframe
    data['Category'], categories = pd.factorize(data.Category) # Replace text categories with integers
    pd.DataFrame(data=categories).to_csv(path_or_buf='categories.csv', index=False, header=False) # Save indices to CSV
    data['Post'] = data['Post'].apply(p.preprocess) # Clean the post
    data = data[data.Post.str.len() > 20].reset_index(drop=True) # Drop samples with text less than 20 characters long

    # Pipeline to create the model and create features
    # clf = SGDClassifier(loss='hinge', penalty='l2', alpha=0.0001, n_iter=10, random_state=42)
    # clf = MultinomialNB()
    clf = SVC(C=5)

    pipeline = Pipeline([('vect', CountVectorizer(ngram_range=(1, 2))), ('tfidf', TfidfTransformer(use_idf=True)), ('clf', clf)])

    # Train the model on the data
    model = pipeline.fit(data.Post, data.Category.values)

    # Cross validation score
    print cross_val_score(pipeline, data.Post, data.Category.values, cv=10)

    # Export model
    joblib.dump(model,'models/SVM.pkl')
