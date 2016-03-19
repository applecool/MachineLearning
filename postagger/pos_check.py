#! /usr/bin/python

import sys,json
import '/usr/lib/nltk'


try:
    data = json.loads(sys.argv[1])

except:
    print "ERROR with input"
    sys.exit(1)

result = data +'hellopurdue'

print json.dumps(result)
