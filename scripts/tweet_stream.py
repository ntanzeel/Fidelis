#!/usr/bin/env python3

import tweepy, json
from tweepy.streaming import StreamListener
from tweepy import OAuthHandler
from tweepy import Stream
from dateutil.parser import parse
import atexit

t = [];


# Listens to incoming tweets
class TweetStreamListener(StreamListener):
    # Connected to Twitter stream
    def on_connect(self):
        print("Connected to stream")

    # When a new Tweet is posted
    def on_status(self, data):
        data = data._json
        # If tweet is not a retweet
        if not data['retweeted'] and "RT @" not in data['text']:
            tweet_id = data['id']
            tweet_text = data['text']
            in_reply_to = data['in_reply_to_status_id']
            screen_name = data['user']['screen_name']
            time = data['created_at'];
            print(json.dumps({'id': tweet_id, 'screen_name': screen_name, 'text': tweet_text, 'in_reply_to': in_reply_to}))
            t.append({'id': tweet_id, 'screen_name': screen_name, 'text': tweet_text, 'in_reply_to': in_reply_to})

    def on_error(self, status):
        print(status)

    def on_disconnect(self, resp):
        print(resp)


def exitfunc():
    tweets = []
    with open('tweets.json', 'a') as f:
        f.write(json.dumps(t, indent=2) + '\n')


if __name__ == "__main__":

    try:
        # Initialise auth variables
        access_token = "3654682401-2tZHxB6j36isknhO08uumRmee24FrjZqcpGxndU"
        access_secret = "wI1yidA047NykeqE4cvV5xDGHTQNqdtFQkrHsrQShcTdJ"
        auth = tweepy.OAuthHandler('GAXWg4dc0cGeOYWjlVxPIoWiW', 'oyQBNhwdGueRNvuDO6p0wheZJXCjhIGi4raweQ5GaIEeRFkFfx')
        auth.set_access_token(access_token, access_secret)
        api = tweepy.API(auth)
        l = TweetStreamListener()
        stream = tweepy.Stream(auth=api.auth, listener=l)
        atexit.register(exitfunc)
        stream.filter(track=['education', 'fashion', 'finance', 'food', 'health', 'home', 'politics', 'sport', 'travel','fine arts'])
    except Exception as e:
        print(e)