<?php
class Login
{

  private $error = "";

  function evaluate($data)
  {
    $team_login = addslashes($data['team_login']);
    $password = addslashes($data['password']);

    $query = "select * from users where team_login = '$team_login' limit 1";

    $DB = new Database();
    $result = $DB->read($query);

    if ($result) {
      $row = $result[0];

      if ($password == $row['password']) {
        $_SESSION['ftcevents_teamid'] = $row['teamid'];
        $_SESSION['team_number'] = $row['team_number'];
      } else {
        $this->error .= "wrong password<br>";
      }
    } else {
      $this->error .= "Wrong teamid<br>";
    }
    return $this->error;
  }

  //todo: use this function to validate event add pages
  //https://www.youtube.com/watch?v=VDsfP8ia_yQ&list=PLY3j36HMSHNWaKUC73RJlwi6oU-WTpTPM&index=41
  function check_login($teamid)
  {
    $query = "select * from users where teamid = '$teamid' limit 1";

    $DB = new Database();
    $result = $DB->read($query);

    if ($result) {
      return true;
    }

    return false;
  }

}