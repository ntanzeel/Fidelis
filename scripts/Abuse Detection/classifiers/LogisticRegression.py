from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_selection import SelectPercentile, chi2
from sklearn import linear_model as lm
from sklearn.pipeline import Pipeline

from features import BadWordCounter
from features.FeatureStacker import FeatureStacker


class LogisticRegression:
    def __init__(self):
        pass

    @staticmethod
    def build_stacked_model():
        select = SelectPercentile(score_func=chi2, percentile=16)

        bad_words = BadWordCounter()

        char_vector = TfidfVectorizer(ngram_range=(1, 5), analyzer="char", binary=False)
        word_vector = TfidfVectorizer(ngram_range=(1, 3), analyzer="word", binary=False, min_df=3)

        logistic_regression = lm.LogisticRegression(tol=1e-8, penalty='l2', C=4)

        features = FeatureStacker([("bad_words", bad_words), ("chars", char_vector), ("words", word_vector)])
        pipeline = Pipeline([('features', features), ('select', select), ('logistic_regression', logistic_regression)])

        return pipeline
