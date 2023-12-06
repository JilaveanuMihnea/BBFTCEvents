import sys
import json
import os.path

eventid = sys.argv[1]
event_name = sys.argv[2]
event_location = sys.argv[3]
event_time = sys.argv[4]
event_lat = sys.argv[5]
event_lng = sys.argv[6]


data_file = open("../data/markers.json", encoding="utf-8")
data = json.load(data_file)
  
for x in range(0, len(data)-1):
  if(data[x]["eventid"]==eventid):
    data[x]["event_name"] = event_name;
    data[x]["event_location"] = event_location;
    data[x]["event_time"] = event_time;
    data[x]["event_lat"] = event_lat;
    data[x]["event_lng"] = event_lng;
    break

data_file.close()

data_file = open("../data/markers.json", "w")
json_object = json.dumps(data, indent=2)
data_file.write(json_object)

data_file.close()
