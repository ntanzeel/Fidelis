import numpy as np
from sklearn.base import BaseEstimator


class BadWordCounter(BaseEstimator):
    def __init__(self):
        self.__load_bad_words("./data/features/Google_Bad_Words.txt")

    def __set_bad_words(self, bad_words):
        self.__bad_words = bad_words

    def __load_bad_words(self, path):
        with open(path) as f:
            bad_words = [l.strip() for l in f.readlines()]

        self.__bad_words = bad_words

    @staticmethod
    def get_feature_names():
        return np.array(['words', 'characters', 'capitals', 'max_word_length', 'average_word_length', 'bad_words',
                         'exclamations', 'mentions', 'spaces', 'caps_ratio', 'bad_ratio'])

    def fit(self, documents, y=None):
        return self

    def transform(self, documents):
        words = [len(comment.split()) for comment in documents]
        characters = [len(comment) for comment in documents]
        capitals = [np.sum([w.isupper() for w in comment.split()]) for comment in documents]

        max_word_length = [np.max([len(w) for w in c.split()]) for c in documents]
        average_word_length = [np.mean([len(w) for w in c.split()]) for c in documents]

        bad_words = [np.sum([c.lower().count(w) for w in self.__bad_words]) for c in documents]
        exclamations = [c.count("!") for c in documents]

        mentions = [c.count("@") for c in documents]

        spaces = [c.count(" ") for c in documents]

        caps_ratio = np.array(capitals) / np.array(words, dtype=np.float)
        bad_ratio = np.array(bad_words) / np.array(words, dtype=np.float)

        return np.array([words, characters, capitals, max_word_length, average_word_length, exclamations, mentions,
                         spaces, bad_ratio, bad_words, caps_ratio]).T
