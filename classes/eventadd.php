<?php

class Event
{

  private $error = "";

  public function evaluate($data, $teamid)
  {
    if ($data["event_lat"] == "")
      $this->error .= "Te rog alege o optiune pentru locatie folosind Autocomplete";
    if ($this->error == "") {
      $this->create_event($data, $teamid);
    } else {
      return $this->error;
    }
  }

  public function create_event($data, $teamid)
  {
    $event_name = addslashes($data["event_name"]);
    $event_desc = addslashes($data["event_desc"]);
    $event_location = addslashes($data["event_location"]);
    $event_time = addslashes($data["event_time"]);
    $event_img = addslashes($data["event_img"]);
    $eventid = addslashes($data["eventid"]);
    //$event_lat = $data["lat"];
    $query = "insert into events (eventid, teamid, event_name, event_desc, event_img, event_time, event_location) values ('$eventid', '$teamid', '$event_name', '$event_desc', '$event_img', '$event_time', '$event_location')";
    $DB = new Database();
    $DB->save($query);


  }
}

?>