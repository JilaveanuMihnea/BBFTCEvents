<?php

class Team{
  private $error;
  public function team_update($data, $team_number){
    $team_bio = addslashes($data['team_bio']);
    $team_contact = addslashes($data['team_contact']);

    if(isset($data['team_login']))
      $team_login = addslashes($data['team_login']);
    if(isset($data['team_login_conf']))  
      $team_login_conf = addslashes($data['team_login_conf']);
    if(isset($data['password']))
      $password = addslashes($data['password']);
    if(isset($data['password_conf']))
      $password_conf = addslashes($data['password_conf']);

    $query = "update users set team_bio = '$team_bio', team_contact = '$team_contact' where team_number = '$team_number'";
    $DB = new Database();
    $DB->runq($query);

    if($team_login){
      if($team_login==$team_login_conf){
        $query = "update users set team_login = '$team_login' where team_number = '$team_number'";
        $DB = new Database();
        $DB->runq($query);
      }else{
        $this->error .= "Numele de utilizator nu corespund <br/>";
      }
    }
    if($password){
      if($password==$password_conf){
        $query = "update users set password = '$password' where team_number = '$team_number'";
        $DB = new Database();
        $DB->runq($query);
      }else{
        $this->error .= "Parolele nu corespund";
      }
    }
    return $this->error;
  }
}
?>