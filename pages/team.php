<?php
  session_start();
  include("../classes/allclasses.php");

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

  $quick = $_GET['nb'];
  $evgetter = new Event();
  $events = $evgetter->get_team_events($quick);
  $DB = new Database();
  $teamdata = $DB->read("select * from users where team_number = '$quick' limit 1");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0"
    />
    <title>Document</title>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com"
    />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap"
      rel="stylesheet"
    />

    <script
      src="https://kit.fontawesome.com/922eec37ec.js"
      crossorigin="anonymous"
    ></script>

    <link
      rel="stylesheet"
      type="text/css"
      href="../style/style.css"
    />
    <link
      rel="stylesheet"
      href="../style/team.css"
    />
  </head>
  <body>
    <!-- navbar + sidemenu -->
    <div id="obfuscate"></div>
    <header id="navbar">
      <a href="#" class="menu-bars" id="show-menu">
        <i class="fa-solid fa-bars fa-lg"></i>
      </a>
      <div id="thing">
        <a href="eventfilter.php" class="ev-search-link">Lista evenimente</a>
        <?php
        if($is_logged){
          echo '<a href="team.php?nb=' . $_SESSION['team_number']. '" class="corner-img"><img src="../data/teamimgs/' . $_SESSION['team_number'] . '.png"></a>';
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
      <div class="team-info">
        <div class="profile-img"><img src="../data/teamimgs/<?php echo $teamdata[0]['team_number']?>.png" /></div>
        <div class="team-text">
          <div class="team-name">
            <h1><?php echo $teamdata[0]['team_name']?><br /><?php echo $teamdata[0]['team_number']?></h1>
          </div>
          <div class="team-bio"><?php echo $teamdata[0]['team_bio']?></div>
        </div>
      </div>
    </div>
    <hr>
    <div class="main-container">
      <h1>Evenimente</h1>
      <div class="events">
        <?php
          if($events){
            foreach($events as $row){
              include("eventcardtemplate.php");
            }
          }
        ?>
        
        <!--todo copy from eventfilter -->
      </div>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
