<?php
session_start();
include("../classes/connect.php");
include("../classes/login.php");

$team_login = "";
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

  $team_login = $_POST['team_login'];
  $password = $_POST['password'];
}


$buttontext = "Conectează-te";
$buttonicon = "fa-right-to-bracket";
$buttonredirect = "login.php";
$addeventredirect = "login.php";


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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

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

  <!-- navbar + sidemenu -->
  <div id="obfuscate"></div>
  <header id="navbar">
    <a href="#" class="menu-bars" id="show-menu">
      <i class="fa-solid fa-bars fa-lg"></i>
    </a>
    <!-- <input type="text" class="searchbar"> -->
    <nav id="nav-menu">
      <ul class="nav-menu-items">
        <div id="navbar-toggle">
          <div class="menu-bars" id="hide-menu">
            <i class="fa-solid fa-bars fa-lg nav-icon"></i>
          </div>
          <a href="#"><img class="website-logo" /> Website Name </a>
        </div>
        <hr />
        <div class="nav-section">
          <!-- add buttons here -->
          <li class="nav-text"><a href="<?php echo $addeventredirect?>"><i class="fa-solid fa-plus nav-icon"></i> Adauga Eveniment</a> </li>
          <li class="nav-text"><a href="<?php echo $buttonredirect?>"><i class="fa-solid <?php echo $buttonicon ?> nav-icon"></i>
              <?php echo $buttontext ?>
            </a> </li>
          <li class="nav-text"><a href="https://www.instagram.com/botsbrave/"><i class="fa-brands fa-instagram nav-icon"></i> Contact</a></li>
          <li class="nav-text"><a href="https://github.com/JilaveanuMihnea/BBFTCEvents"><i class="fa-brands fa-github nav-icon"></i> Github</a></li>
        </div>
      </ul>
    </nav>
  </header>


  <div class="main-container">
    <h1>Conectează-te</h1>
    <br>
    <hr />
    <br>
    <form>
      <input class="text" name="team_login" value="<?php echo $team_login ?>" type="text" placeholder="Nume utilizator" required> <br> <br>
      <input class="text" name="password" value="<?php echo $password ?>" type="password" placeholder="Parola" required> <br> <br>

      <input class="submit" type="submit" value="Conectează-te">
    </form>

  </div>

  <script src="../js/script.js"></script>
</body>
</html>
