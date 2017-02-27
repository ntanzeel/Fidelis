from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_selection import SelectPercentile, chi2
from sklearn import svm
from sklearn.pipeline import Pipeline

from features import BadWordCounter
from features.FeatureStacker import FeatureStacker


class SVM:
    def __init__(self):
        pass

    @staticmethod
    def build_stacked_model():
        select = SelectPercentile(score_func=chi2, percentile=16)

        classifier = svm.SVC(probability=True)
        char_vector = TfidfVectorizer(ngram_range=(1, 5), analyzer="char", binary=False)
        word_vector = TfidfVectorizer(ngram_range=(1, 3), analyzer="word", binary=False, min_df=3)
        bad_words = BadWordCounter()

        features = FeatureStacker([("bad_words", bad_words), ("chars", char_vector), ("words", word_vector)])
        pipeline = Pipeline([('features', features), ('select', select), ('classifier', classifier)])

        return pipeline
