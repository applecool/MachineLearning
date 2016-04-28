

#########################################################

import sys, json
import nltk
from nltk.corpus import brown
from collections import Counter
from textblob import Word

#########################################################
# Load the data that PHP sent us


try:
    data = json.loads(sys.argv[1])
    #data = raw_input()
except:
    print "ERROR with input"
    sys.exit(1)

#print data


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
nouns = []
verbs = []
predict_list = []
#word_list = []
fil_wordlist = []
neglect_list = ['and','the','a','of','an','as','at','any','are','by','is','to',',','.','it','its','then','with','in',';','them','most','you','your','yours','who','why','what','<','>','?',':','-']
unfil_list = []
filtered_list = []
reco_list = []

tokens = nltk.word_tokenize(sentence_rc)
for i, word in enumerate(tokens):
    #print i
    predicted_tag = classifier.classify(pos_features(tokens,i))
    #print predicted_tag
    predict_list.append(predicted_tag)

    #filtering the nouns and adding them to the nouns list
    if predicted_tag == "NNS" or predicted_tag =="NN":
        nouns.append(word)

    #filtering the verbs and adding them to the verbs list
    if predicted_tag == "VB" or predicted_tag =="VBD" or predicted_tag =="VBG" or predicted_tag =="VBN" or predicted_tag =="VBZ" or predicted_tag =="VBP" :
        verbs.append(word)

    #word_list.append(word)
    
    #filtering out the articles and adding them to the fil_wordlist
    if not any(word in s for s in neglect_list):
        fil_wordlist.append(word)

    #print predict_list
    answer = answer + ' (' + '(' + word + '),' + '(' + predicted_tag + ')' + '), '

#print predict_list

#gives the frequency of the pos tags - Counter returns a counter object
count_val = Counter(predict_list)

#gives the frequency of the words - Counter returns a counter object
count_word = Counter(fil_wordlist)

#gives back the maximum count word
max_word = max(count_word, key=count_word.get)
#print 'max_occurance:',max_word

#getting the suggestions for the maximum frequency word
new_max_word = Word(max_word)
new_word_set = new_max_word.synsets
unfil_new_list = []
filtered_new_list = []
reco_new_list = []
final_reco_new_list = []

for x in new_word_set:
    unfil_new_list.append(x.hypernyms())

#print 'UNFIL_NEW_LIST:', unfil_new_list

filtered_new_list = [i for i in unfil_new_list if i]

#print 'FILTERED_NEW_LIST:', filtered_new_list

for y in filtered_new_list:
    reco_new_list.append(y[0].name().split('.')[0])

#print 'RECO_NEW_LIST', reco_new_list

set_new_list = set(reco_new_list)

c = ', '

for y in set_new_list:
    final_reco_new_list.append(y)

#print final_reco_new_list

#gives the recommendations based on the maximum word
print 'Recommendations-1:',c.join(final_reco_new_list)

#print fil_wordlist

#Counting the verbs and nouns
count_verbs = Counter(verbs)
count_nouns = Counter(nouns)


# print count_val
# print count_word

#required
# print count_verbs
# print count_nouns

max_noun = max(count_nouns, key=count_nouns.get)
#print 'highest_occ_noun:',max_noun

word = Word(max_noun)
word_set = word.synsets

for x in word_set:
    unfil_list.append(x.hypernyms())
    
filtered_list = [i for i in unfil_list if i]

for y in filtered_list:
    reco_list.append(y[0].name().split('.')[0])

#####reco_list.append(x.hypernyms()[0].name().split('.')[0])

set_list = set(reco_list)

final_reco_list = []
comma = ', '
for y in set_list:
    final_reco_list.append(y)

#gives the recommendations based on the maximum number of nouns
print 'Recommendations-2:',comma.join(final_reco_list)

#########################################
#recommendations on the verbs
# max_verb = max(count_verbs, key=count_verbs.get)
# print 'highest_occ_verb:',max_verb

# word_verb = Word(max_verb)
# word_set_verb = word_verb.synsets

# unfil_verb_list = []
# filtered_verb_list = []
# reco_verb_list = []
# set_verb_list = []

# for x in word_set_verb:
#     unfil_verb_list.append(x.hypernyms())
    
# filtered_verb_list = [i for i in unfil_verb_list if i]

# for y in filtered_verb_list:
#     reco_verb_list.append(y[0].name().split('.')[0])

#####reco_list.append(x.hypernyms()[0].name().split('.')[0])

# set_verb_list = set(reco_verb_list)

# final_reco_verb_list = []

# co = ', '
# for y in set_verb_list:
#     final_reco_verb_list.append(y)

#gives the recommendations based on the maximum number of nouns
# print 'Recommendations-3:',comma.join(final_reco_verb_list)


result = answer


#print nltk.classify.accuracy(classifier, test_set)


#########################################################
# Send it to stdout (to PHP)
#print json.dumps(result)
#print result


#End
#########################################################
