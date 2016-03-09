#! /var/chroot/home/content/31/5769131/myenv/bin/python

#########################################################

import sys, json
import nltk
from nltk.corpus import brown
#from nltk.corpus import wordnet as wn
#from __future__ import division
#import re
from urllib import urlopen

#########################################################
# Load the data that PHP sent us

try:
    data = json.loads(sys.argv[1])
except:
    print "ERROR"
    sys.exit(1)

#print data

#########################################################
## Access text from the web (such as data)

url = "http://www.galacticbackwater.com/data/iris.csv"
#raw = urlopen(url).read()
#result = raw

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

from nltk.corpus import names
import random

def gender_features2(name):
    features = {}
    features["firstletter"] = name[0].lower()
    features["lastletter"] = name[-1].lower()
    for letter in 'abcdefghijklmnopqrstuvwxyz':
        features["count(%s)" % letter] = name.lower().count(letter)
        boll = letter in name.lower()
        features["has(%s)" % letter] = boll
    return features

#################################################################

list1 = [(name, 'male') for name in names.words('male.txt')]
list2 = [(name, 'female') for name in names.words('female.txt')]
names = (list1 + list2)
random.shuffle(names)

featuresets = [(gender_features2(n), g) for (n, g) in names]
#print featuresets
train_set, test_set = featuresets[800:], featuresets[:200]
classifier = nltk.NaiveBayesClassifier.train(train_set)
predicted_class = classifier.classify(gender_features2(data))
#predicted_class = classifier.classify(gender_features2('neo'))

#########################################################

dutch = brown.words()
#print dutch[1]

#result = {'status': 'Yes!'}
#result = 'Ricardo A. Calix, Ph.D., ' + data + ', ' + dutch[1]
result = predicted_class

#########################################################
# Send it to stdout (to PHP)
print json.dumps(result)


#End
#########################################################
