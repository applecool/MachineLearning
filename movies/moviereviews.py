#! /var/chroot/home/content/31/5769131/myenv/bin/python

#########################################################

import sys, json
import nltk
from nltk.corpus import brown
#from nltk.corpus import wordnet as wn
#from __future__ import division
#import re
from urllib import urlopen
#from BeautifulSoup import BeautifulSoup


#########################################################
# Load the data that PHP sent us

#data = 'http://www.gutenberg.org/cache/epub/14868/pg14868.txt'
try:
    data = json.loads(sys.argv[1])
except:
    print "ERROR with input"
    sys.exit(1)

#print data

#########################################################
## Access text from the web (such as data)

#url = "http://www.galacticbackwater.com/data/iris.csv"
#url = data
#raw = urlopen(url).read()
#result = raw
#soup= BeautifulSoup(raw)
#cleantext = soup.text
input_string = data
#print input_string

##########################################################
##  Wordnet

#my_wordnet = wn.synset('car.n.01').lemma_names
#my_wordnet = wn.synset('car.n.01').definition
#result = my_wordnet

#########################################################
## stemming

##porter = nltk.PorterStemmer()
##result = porter.stem('distributing')

#########################################################
## Part of Speech Tagging (not working)
## this needs numpy

#thesentence = "And now for something completely different"
#text = nltk.word_tokenize(thesentence)
#temp = nltk.pos_tag(text)
#print temp

##########################################################
## Naive Bayes Classifier

from nltk.corpus import movie_reviews
import random


all_words = nltk.FreqDist(w.lower() for w in movie_reviews.words())
word_features = all_words.keys()[:2000]

def document_features(document):
    document_words = set(document)
    features = {}
    for word in word_features:
        bool_var = word in document_words
        features['contains(%s)' % word] = bool_var
    return features

#################################################################

documents = [(list(movie_reviews.words(fileid)), category) for category in movie_reviews.categories() for fileid in movie_reviews.fileids(category)]
random.shuffle(documents)

featuresets = [(document_features(d), c) for (d, c) in documents]
#print featuresets
train_set, test_set = featuresets[100:], featuresets[:100]
classifier = nltk.NaiveBayesClassifier.train(train_set)
predicted_class = classifier.classify(document_features(input_string))


#########################################################

#dutch = brown.words()
#print dutch[1]

#result = {'status': 'Yes!'}
#result = 'Ricardo A. Calix, Ph.D., ' + data + ', ' + dutch[1]
result = predicted_class

#########################################################
# Send it to stdout (to PHP)

print json.dumps(result)


#End
#########################################################






