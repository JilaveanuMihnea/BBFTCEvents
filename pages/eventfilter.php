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

  date_default_timezone_set('Europe/Bucharest');
  $date = date('m/d/Y h:i:s a', time());

  $event = new Event();
  $events = $event->get_events($_GET);
    // echo '<br/>';
    // $evdate= date('m/d/Y h:i:s a', strtotime($events[0]['event_time']));
    // echo '<br/>';
    // if($evdate >= $date){
    //   echo 'nu inca';
    // }
  


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event search</title>

    <script
      src="https://kit.fontawesome.com/922eec37ec.js"
      crossorigin="anonymous"
    ></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" type="text/css" href="../style/style.css" />
    <link rel="stylesheet" type="text/css" href="../style/eventfilter.css" />
  </head>
  <body>
    <div id="popup-obfuscate"></div>
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

    <div id="show-filters">
      <i class="fa-solid fa-filter fa-lg"></i>Filtreaza evenimente
    </div>
    <hr />

    <div class="main-container">
      <?php
      if($events){
        foreach($events as $row){
          include("eventcardtemplate.php");
        }
      }else{
        
      }
        
      ?>
      
    </div>

    <form method="get" action="" class="popup-form">
      <div class="popup">
        <div>
          <h1 class="popup-title">Selecteaza filtre</h1>
          <i class="fa-solid fa-xmark close-button"></i>
          <hr />
        </div>
        <div class="flexhere">
          <!-- judete -->
          <div class="dropdown">
            <div class="select-btn">
              <span class="btn-text" id="btn-text-jud">Selecteaza judete</span>
              <span class="arrow-down">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </div>
            <ul class="list-items" id="jud">
              <!-- <label for="Prahova">
                <li class="item">
                  <input
                    type="checkbox"
                    name="Prahova"
                    id="Prahova"
                    class="selection"
                  />
                  <span class="checkbox">
                    <i class="fa-solid fa-check check-icon"></i>
                  </span>
                  <span class="item-text">Prahova</span>
                </li>
              </label> -->
            </ul>
          </div>

          <!-- online/fizic -->
          <div class="dropdown">
            <div class="select-btn">
              <span class="btn-text" id="btn-text-fmt">Selecteaza format</span>
              <span class="arrow-down">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </div>
            <ul class="list-items" id="fmt">
              <!-- todo: insert dropdown options here -->
            </ul>
          </div>

          <!-- tip eveniment -->
          <div class="dropdown">
            <div class="select-btn">
              <span class="btn-text" id="btn-text-tip">Selecteaza tip</span>
              <span class="arrow-down">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </div>
            <ul class="list-items" id="tip">
              <!-- todo: insert dropdown options here -->
            </ul>
          </div>
          <center>
            <input type="submit" value="Filtreaza" class="submit" />
          </center>
        </div>
      </div>
    </form>
    <script src="../js/eventfilter.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>
