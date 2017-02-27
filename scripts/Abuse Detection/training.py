from sklearn.model_selection import GridSearchCV

import data
from classifiers import LogisticRegression
from classifiers import SVM
from sklearn.metrics import roc_auc_score as auc_score


def build_lr_model():
    print "Reading Data"
    comments, labels = data.get_train_data()
    test_comments, test_labels = data.get_test_data()

    print "Building Logistic Regression Pipeline"
    lr_pipeline = LogisticRegression.build_stacked_model()

    print "Training Logistic Regression"
    lr_pipeline.fit(comments, labels)

    print "Predicting Logistic Regression"
    predictions = lr_pipeline.predict_proba(test_comments)

    print auc_score(test_labels, predictions[:, 1])


def build_svc_model():
    print "Reading Data"
    comments, labels = data.get_train_data()
    test_comments, test_labels = data.get_test_data()

    print "Building Stacked SVC Pipeline"
    lr_pipeline = SVM.build_stacked_model()

    print "Training SVC"
    lr_pipeline.fit(comments, labels)

    print "Predicting SVC"
    predictions = lr_pipeline.predict_proba(test_comments)

    print auc_score(test_labels, predictions[:, 1])


def test_svc_model():
    print "Reading Data"
    comments, labels = data.get_train_data()
    test_comments, test_labels = data.get_test_data()

    print "Building Stacked SVC Pipeline"
    pipeline = SVM.build_stacked_model()

    param_grid = {
        'classifier__C': [0.1, 0.25, 0.5, 0.75, 1.0, 2, 5, 10],
        'classifier__kernel': ['linear', 'rbf']
    }

    grid = GridSearchCV(pipeline, cv=10, param_grid=param_grid, verbose=4, n_jobs=12, scoring='roc_auc')
    grid.fit(comments, labels)

    print grid.best_score_
    print grid.best_params_


if __name__ == "__main__":
    build_lr_model()
