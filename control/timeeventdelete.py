import json
import os.path
import schedule
import time


def eventpassed(ctime):
  return time.localtime().tm_year>=int(ctime[0:4]) and time.localtime().tm_mon>=int(ctime[5:7]) and time.localtime().tm_mday>=int(ctime[8:10]) and time.localtime().tm_hour>int(ctime[11:13])

def seekndestroy():
    with open(os.path.dirname(__file__) + "/../data/markers.json", encoding="utf-8") as data_file:
      data = json.load(data_file)
    # maybe put this back in the with statement?
    for x in range(0, len(data)-1):
      if(eventpassed(data[x]["event_time"])):
        data.pop(x)
    with open(os.path.dirname(__file__) + "/../data/markers.json", "w") as data_file:
      json_object = json.dumps(data, indent=2)
      data_file.write(json_object)
    

schedule.every().second.do(seekndestroy)

while 1:
    schedule.run_pending()
    time.sleep(1);