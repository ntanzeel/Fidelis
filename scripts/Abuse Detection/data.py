import pandas as pd
import numpy as np


def __load_data(path, drop):
    data = pd.read_csv(path).drop(drop, axis=1)
    data['Comment'] = __process_comments(data['Comment'])

    return data


def __process_comments(comments):
    return comments.str.strip().str.strip('"').str.replace('_', ' ').str.decode('string_escape').str.decode(
        'unicode-escape')


def __deduplicate(comments, labels):
    hashes = np.array([hash(c) for c in comments])
    unique_hashes, indices = np.unique(hashes, return_inverse=True)
    doubles = np.where(np.bincount(indices) > 1)[0]
    mask = np.ones(len(comments), dtype=np.bool)
    for i in doubles:
        not_the_first = np.where(indices == i)[0][1:]
        mask[not_the_first] = False
    return comments[mask], labels[mask]


def get_train_data():
    data = __load_data('./data/train.csv', ['Date'])

    return __deduplicate(data['Comment'].values, data['Insult'].values)


def get_extended_data():
    data = __load_data('./data/train.csv', ['Date'])
    data = data.append(__load_data('./data/test_with_solutions.csv', ['Date', 'Usage']), ignore_index=True)

    return __deduplicate(data['Comment'].values, data['Insult'].values)


def get_verification_data():
    data = __load_data('./data/impermium_verification_labels.csv', ['id', 'Date', 'Usage'])

    return __deduplicate(data['Comment'].values, data['Insult'].values)


def get_test_data():
    data = __load_data('./data/test_with_solutions.csv', ['Date', 'Usage'])

    return __deduplicate(data['Comment'].values, data['Insult'].values)
