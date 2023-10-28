<?php
session_start();
class Login
{

  private $error = "";

  function evaluate($data)
  {
    $teamid = addslashes($data['teamid']);
    $password = addslashes($data['password']);

    $query = "select * from users where teamid = '$teamid' limit 1";

    $DB = new Database();
    $result = $DB->read($query);

    if ($result) {
      $row = $result[0];

      if ($password == $row['password']) {
        $_SESSION['ftcevents_teamid'] = $row['teamid'];
      } else {
        $this->error .= "wrong password<br>";
      }
    } else {
      $this->error .= "Wrong teamid<br>";
    }
    return $this->error;
  }

}