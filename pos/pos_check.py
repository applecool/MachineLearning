#!/usr/bin/python

import sys
import json


try:
    data = json.loads(sys.argv[1])

except:
    print "ERROR with input"
    sys.exit(1)

result = data +'hellopurdue'

print json.dumps(result)
