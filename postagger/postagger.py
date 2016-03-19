#! /usr/bin/python

#########################################################

#import sys, json
#import nltk
#from nltk.corpus import brown

#########################################################
# Load the data that PHP sent us


try:
    data = json.loads(sys.argv[1])
    #data = raw_input()
except:
    print "ERROR with input"
    sys.exit(1)


def pos_features(sentence, i):
    features = {"suffix(1)": sentence[i][-1:],
                "suffix(2)": sentence[i][-2:],
                "suffix(3)": sentence[i][-3:]}
    if i == 0:
        features["prev-word"] = "<START>"
    else:
        features["prev-word"] = sentence[i-1]
    return features


#print pos_features(brown.sents()[0], 8)


tagged_sents = brown.tagged_sents(categories='news')
featuresets = []
for tagged_sent in tagged_sents:
    #print tagged_sent
    untagged_sent = nltk.tag.untag(tagged_sent)
    for i, (word, tag) in enumerate(tagged_sent):
        featuresets.append( (pos_features(untagged_sent, i), tag) )


size = int(len(featuresets) * 0.1)
train_set, test_set = featuresets[size:], featuresets[:size]

classifier = nltk.NaiveBayesClassifier.train(train_set)

#sentence_rc = 'Truly, truly, I say to you, a slave is not greater than his master, nor is one who is sent greater than the one who sent him. King James Bible'
sentence_rc = data
answer = ''
tokens = nltk.word_tokenize(sentence_rc)
for i, word in enumerate(tokens):
    #print i
    predicted_tag = classifier.classify(pos_features(tokens,i))
    answer = answer + ' (' + '(' + word + '),' + '(' + predicted_tag + ')' + '), '

result = answer

print json.dumps(result)
