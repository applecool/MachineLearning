#! /bin/python

#########################################################

import sys, json
import nltk
from nltk.corpus import brown
from urllib import urlopen


#########################################################
# Load the data that PHP sent us


try:
    data = json.loads(sys.argv[1])
except:
    print "ERROR with input"
    sys.exit(1)

#print data

#########################################################
## Access text from the web (such as data)

input_string = data
#print input_string

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
print featuresets
train_set, test_set = featuresets[100:], featuresets[:100]
classifier = nltk.NaiveBayesClassifier.train(train_set)
predicted_class = classifier.classify(document_features(input_string))


result = predicted_class

#########################################################
# Send it to stdout (to PHP)

print json.dumps(result)


#End
#########################################################
