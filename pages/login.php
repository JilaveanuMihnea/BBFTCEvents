<?php
session_start();
include("../classes/connect.php");
include("../classes/login.php");
include("../classes/image.php");
include("../classes/events.php");
include("../classes/team.php");

$buttontext = "Conectează-te";
$buttonicon = "fa-right-to-bracket";
$buttonredirect = "login.php";
$addeventredirect = "login.php";

$is_logged = false;
if (isset($_SESSION["ftcevents_teamid"]) && is_numeric($_SESSION['ftcevents_teamid'])) {
  $login = new Login();
  $is_logged = $login->check_login($_SESSION['ftcevents_teamid']);
  if ($is_logged) {
    $buttontext = "Deconectează-te";
    $buttonicon = "fa-right-from-bracket";
    $buttonredirect = 'logout.php';
    $addeventredirect = 'eventadd.php';
  }
}


$team_login = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $login = new Login();
  $result = $login->evaluate($_POST);

  if ($result != "") {
    echo $result;
  } else {
    header("Location: ../index.php");
    die;
  }

  $team_login = $_POST['team_login'];
  $password = $_POST['password'];
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Conectează-te</title>
  <link rel="icon"  href="../resources/img/favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap"
    rel="stylesheet"
  />

  <script
    src="https://kit.fontawesome.com/922eec37ec.js"
    crossorigin="anonymous"
  ></script>

  <link rel="stylesheet" type="text/css" href="../style/style.css" />
  <link href="../style/login.css?<?=filemtime("../style/login.css")?>" rel="stylesheet" type="text/css" />
</head>

<body>

  <?php include("navbar.php") ?>

  <div class="main-container">
    <h1>Conectează-te</h1>
    <br>
    <hr />
    <br>
    <form method="post" action="">
      <input class="text" name="team_login" value="<?php echo $team_login ?>" type="text" placeholder="Nume utilizator"  autocomplete="off" required> <br> <br>
      <input class="text" name="password" value="<?php echo $password ?>" type="password" placeholder="Parolă" required> <br> <br>

      <input class="submit" type="submit" value="Conectează-te">
    </form>
    <div class="signup-info">
      Conturile sunt doar pentru echipe de robotică <br>
      Pentru creearea unui cont, scrieţi-ne pe instagram @<a href="https://www.instagram.com/botsbrave/">botsbrave</a>
    </div>
  </div>

  <script src="../js/script.js"></script>
</body>
</html>
