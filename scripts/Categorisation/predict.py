import pandas as pd
from sklearn.externals import joblib
import preprocess as p
import sys

if __name__ == "__main__":
    post = sys.argv[1]
    print post
    model = joblib.load('./models/SGD.pkl')
    df = pd.DataFrame()
    df['Post'] = [p.preprocess("I wish Donald Trump would stop forcing through shitty policies")]
    #print p.preprocess("I wish Donald Trump would stop forcing through shitty policies")
