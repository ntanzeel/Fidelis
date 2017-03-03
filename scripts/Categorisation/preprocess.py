from nltk.corpus import stopwords
import preprocessor as p
import string
from nltk.stem import WordNetLemmatizer
from nltk import ngrams

lemma = WordNetLemmatizer()
p.set_options(p.OPT.URL, p.OPT.MENTION, p.OPT.RESERVED, p.OPT.EMOJI, p.OPT.SMILEY, p.OPT.NUMBER)
stops = set(stopwords.words('english'))
replace_punc = str.maketrans(string.punctuation, ' '*len(string.punctuation))

def preprocess(post):
    post = post.encode('ascii', errors='ignore').decode('utf-8')
    filtered = p.clean(post).lower()
    filtered = str(filtered).translate(replace_punc)
    filtered = p.clean(filtered)
    filtered = [lemma.lemmatize(word) for word in filtered.split() if word not in stops]
    return(filtered)

if __name__=='__main__':
    print(preprocess('@BBCSport HAVE Watford  am ve having #lol won against 20 Arsenal\'s in the leagues, for the first time...'))
