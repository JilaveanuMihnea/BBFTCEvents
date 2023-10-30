<?php

class Event
{

  private $error = "";

  public function evaluate($data)
  {
    foreach ($data as $key => $value) {
      if (empty($value)) {
        $error .= $key . " is empty!<br>";
      }
      if (!$error) {


        $this->create_event($data);
      } else {
        return $error;
      }
    }
  }

  public function create_event($data)
  {
    $query = "insert into events (eventid, teamid, event_name, event_desc, event_img, event_time, event_location) values ($eventid, $teamid, $event_name, $event_desc, $event_img, $event_time, $event_location)";
    $DB = new Database();
    $DB->save($query);
    // $event_name = addslashes($data["event_name"]);
    // $event_desc = addslashes($data["event_desc"]);
    // $event_location = addslashes($data["event_location"]);
    // $event_time = addslashes($data["event_time"]);
    // $event_img = addslashes($data["event_img"]);
    // $event_lat = $data["lat"];

  }


  private function create_eventid()
  {

  }
}

?>