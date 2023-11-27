import sys
import json
import os.path

eventid = sys.argv[1]

with open(os.path.dirname(__file__) + "/../data/markers.json", encoding="utf-8") as data_file:
  data = json.load(data_file)
  
# maybe put this back in the with statement?
for x in range(0, len(data)-1):
  if(data[x]["eventid"]==eventid):
    data.pop(x)
    break

with open(os.path.dirname(__file__) + "/../data/markers.json", "w") as data_file:
  json_object = json.dumps(data, indent=2)
  data_file.write(json_object)


