<?php
include("../classes/connect.php");
include("../classes/login.php");

$teamid = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $login = new Login();
  $result = $login->evaluate($_POST);

  if ($result != "") {
    echo $result;
  } else {
    header("Location: index.php");
    die;
  }

  $teamid = $_POST['teamid'];
  $password = $_POST['password'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/login_style.css">
  <title>Login</title>
</head>

<body>
  <div class="wrapper">
    <center><img class="logo" src="https://shorturl.at/vJV16" ; height="150" width="100"></center>
    <form method="post" action="">

      <input value="<?php echo $teamid ?>" name="teamid" type="text" id="text" placeholder="teamid" required><br><br>
      <input value="<?php echo $password ?>" name="password" type="text" id="text" placeholder="password"
        required><br><br>

      <center><input type="submit" id="button" value="Log in"></center>

    </form>
  </div>
</body>

</html>