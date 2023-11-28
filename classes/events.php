<?php

class Event
{

  private $error = "";

  public function evaluate($data)
  {
    $ok = true;
    $okauto = true;
    foreach($data as $key => $value)
      if(empty($value) && $key!='event_lat' && $key!='event_lng')
        $ok = false;
    
    if($ok==false) 
      $this->error .= "Te rog completeaza toate campurile";
  
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

  public function get_events($conditions){
    date_default_timezone_set('Europe/Bucharest');
    $query = "select * from events order by event_time asc";
    if($conditions){
      $query = "select * from events";
      $query .= " where";
      $jud = "";
      $fmt = "";
      $tip = "";
      $cnt = 0;
      foreach($conditions as $key => $value){
        if(strlen($key)<=2){
          if($jud=="")
            $jud .= '(\'' . $key . '\'';
          else
            $jud .= ',\'' . $key . '\'';
        }else if(strlen($key)==3){
          if($fmt=="")
            $fmt .= '(\'' . $key . '\'';
          else
            $fmt .= ',\'' . $key . '\'';
        }else{
          if($tip=="")
            $tip .= '(\'' . $key . '\'';
          else
            $tip .= ',\'' . $key . '\'';
        }
      }
      if($jud){
        $query .= " event_jud in " . $jud . ')';
        $cnt = 1;
      }
      if($fmt){
        if($cnt) $query .= " and";
        $query .= " event_format in " . $fmt . ')';
        $cnt = 1;
      }
      if($tip){
        if($cnt) $query .= " and";
        $query .= " event_type in " . $tip . ')';
      }
    }
    
    $DB = new Database();
    $result = $DB->read($query);

    return $result;
  }

  public function get_event($id){
    $query = "select * from events where eventid = '$id' limit 1";
    $DB = new Database();
    return $DB->read($query);
  }

  public function get_team_events($team_number){
    $query = "select * from events where team_number = '$team_number'";
    $DB = new Database();
    return $DB->read($query);
  }

  public function delete_event($eventid){
    $query = "delete from events where eventid = '$eventid'";
    $DB = new Database();
    $DB->delete($query);
  }
}


?>