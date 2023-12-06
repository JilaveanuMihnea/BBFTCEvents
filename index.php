<?php
session_start();
// echo $_SESSION['ftcevents_teamid'];
include("classes/connect.php");
include("classes/login.php");
include("classes/image.php");
include("classes/events.php");
include("classes/team.php");

$buttontext = "Conectează-te";
$buttonicon = "fa-right-to-bracket";
$buttonredirect = "pages/login.php";
$addeventredirect = "pages/login.php";

$is_logged = false;

if (isset($_SESSION["ftcevents_teamid"]) && is_numeric($_SESSION['ftcevents_teamid'])) {
  $login = new Login();
  $is_logged = $login->check_login($_SESSION['ftcevents_teamid']);
  if ($is_logged) {
    $buttontext = "Deconectează-te";
    $buttonicon = "fa-right-from-bracket";
    $buttonredirect = 'pages/logout.php';
    $addeventredirect = 'pages/eventadd.php';
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Master Plan</title>
  <link rel="icon"  href="resources/img/favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/922eec37ec.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <link rel="stylesheet" href="style/index.css" />
</head>

<body>
  <!-- navbar + sidemenu -->
  <div id="obfuscate"></div>
  <header id="navbar">
    <div id="otherthing">
      <a href="#" class="menu-bars" id="show-menu">
        <i class="fa-solid fa-bars fa-lg"></i>
      </a>
      <a href="#"><img class="website-logo" src="resources/img/logo.png"/></a>
    </div>
    
    <div id="thing">
      <a href="pages/eventfilter.php?meet=on&league=on" class="ev-search-link">Evenimente oficiale</a>
      <a href="pages/eventfilter.php" class="ev-search-link">Listă evenimente</a>
      <?php
      if($is_logged){
        echo '<a href="pages/team.php?nb=' . $_SESSION['team_number']. '" class="corner-img"><img src="data/teamimgs/' . $_SESSION['team_number'] . '.png"></a>';
      }
        
      ?>
    </div>
    <!-- <input type="text" class="searchbar"> -->
    <nav id="nav-menu">
      <ul class="nav-menu-items">
        <div id="navbar-toggle">
          <div class="menu-bars" id="hide-menu">
            <i class="fa-solid fa-bars fa-lg nav-icon"></i>
          </div>
          <a href="#"><img class="website-logo" src="resources/img/logo.png"/></a>
        </div>
        <hr />
        <div class="nav-section">
          <!-- add buttons here -->
          <a href="<?php echo $addeventredirect?>"><li class="nav-text"><i class="fa-solid fa-plus nav-icon"></i> Adaugă Eveniment </li></a>
          <a href="<?php echo $buttonredirect?>"><li class="nav-text"><i class="fa-solid <?php echo $buttonicon ?> nav-icon"></i>
              <?php echo $buttontext ?>
             </li></a>
          <a href="https://linktr.ee/Brave.Bots" target="_blank"><li class="nav-text"><i class="fa-solid fa-phone nav-icon"></i> Contact</li></a>
          <a href="https://github.com/JilaveanuMihnea/BBFTCEvents/issues/new/choose" target="_blank"><li class="nav-text"><i class="fa-brands fa-github nav-icon"></i> Github</li></a>
        </div>
      </ul>
    </nav>
  </header>


  <div id="map"></div>

  <script src="js/script.js"></script>
  <script src="js/map.js"></script>
  <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByIrjtaUZVRpacy8BFWLoHpmFpDhu_RUk&callback=initMap"> </script>

</body>

</html>