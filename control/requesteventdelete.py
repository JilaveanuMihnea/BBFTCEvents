import sys
import json
import os.path

print(os.path.dirname(__file__))

eventid = sys.argv[1]

data_file = open("../data/markers.json", encoding="utf-8")
data = json.load(data_file)
  
for x in range(0, len(data)-1):
  if(data[x]["eventid"]==eventid):
    data.pop(x)
    break

data_file.close()

data_file = open(os.path.dirname(__file__) + "/../data/markers.json", "w")
json_object = json.dumps(data, indent=2)
data_file.write(json_object)

data_file.close()

os.remove("../data/eventimgs/" + eventid +".png");
