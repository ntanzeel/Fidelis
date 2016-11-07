#!/usr/bin/env python

import tweepy, json
from tweepy.streaming import StreamListener
from tweepy import OAuthHandler
from tweepy import Stream
from dateutil.parser import parse


#Listens to incoming tweets
class TweetStreamListener(StreamListener):

    #Connected to Twitter stream
    def on_connect(self):
        print "Connected to stream"

    #When a new Tweet is posted
    def on_status(self, data):
        data = data._json
        print data
        with open('tweets.json','a') as f:
            f.write(json.dumps(data)+'\n')

    def on_error(self, status):
        print status

    def on_disconnect(self, resp):
        print resp


if __name__ == "__main__":

    try:
        #Initialise auth variables
        access_token = "3654682401-2tZHxB6j36isknhO08uumRmee24FrjZqcpGxndU"
        access_secret = "wI1yidA047NykeqE4cvV5xDGHTQNqdtFQkrHsrQShcTdJ"
        auth = tweepy.OAuthHandler('GAXWg4dc0cGeOYWjlVxPIoWiW', 'oyQBNhwdGueRNvuDO6p0wheZJXCjhIGi4raweQ5GaIEeRFkFfx')
        auth.set_access_token(access_token,access_secret)
        api = tweepy.API(auth)
        l = TweetStreamListener()
        stream = tweepy.Stream(auth=api.auth, listener=l)
        stream.filter(track=["#election2016","#brexit"])
    except Exception, e:
        print e
