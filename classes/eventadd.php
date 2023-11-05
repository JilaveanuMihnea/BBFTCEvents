<?php

class Event
{

  private $error = "";

  public function evaluate($data)
  {
    $ok = true;
    $okauto = true;
    foreach($data as $key => $value){
      if(empty($value)){
        if($key=='event_lat' || $key=='event_lng'){
          $okauto = false;
        }else{
          $ok = false;
        }
      }
    }
    
    if($ok==false) 
      $this->error .= "Te rog completeaza toate campurile";
    else if($okauto==false) 
      $this->error .= "Te rog alege o optiune automata pentru locatie";
  
    if ($this->error == "") {
      $this->create_event($data);
    } else {
      return $this->error;
    }
  }

  public function create_event($data)
  {
    $team_name = addslashes($data["team_name"]);
    $team_number = addslashes($data['team_number']);
    $event_type = addslashes($data["event_type"]);
    $event_jud = addslashes($data["event_jud"]);
    $event_format = addslashes($data["event_format"]);
    $event_name = addslashes($data["event_name"]);
    $event_desc = addslashes($data["event_desc"]);
    $event_location = addslashes($data["event_location"]);
    $event_time = addslashes($data["event_time"]);
    $event_img = addslashes($data["event_img"]);
    $eventid = addslashes($data["eventid"]);
    //$event_lat = $data["lat"];
    $query = "insert into events (eventid, team_number, team_name, event_name, event_desc, event_img, event_time,  event_jud, event_format, event_type, event_location) values ('$eventid', '$team_number', '$team_name', '$event_name', '$event_desc', '$event_img', '$event_time', '$event_jud', '$event_format', '$event_type', '$event_location')";
    $DB = new Database();
    $DB->save($query);
  }
}

?>