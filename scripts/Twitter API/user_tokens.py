import tweepy

consumer_token = 'GAXWg4dc0cGeOYWjlVxPIoWiW'
consumer_secret = 'oyQBNhwdGueRNvuDO6p0wheZJXCjhIGi4raweQ5GaIEeRFkFfx'

auth = tweepy.OAuthHandler(consumer_token, consumer_secret)

try:
    print auth.get_authorization_url()
except tweepy.TweepError:
    print 'Error! Failed to get request token.'
    exit()

verifier = raw_input('Verifier:')

try:
    auth.get_access_token(verifier)
except tweepy.TweepError:
    print 'Error! Failed to get access token.'
    exit()

print auth.access_token
print auth.access_token_secret
