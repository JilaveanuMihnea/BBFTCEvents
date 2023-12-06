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
    <title>Listă Evenimente</title>
    <link rel="icon"  href="../resources/img/favicon.png">

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
    
    <?php include("navbar.php") ?>

    <div id="show-filters">
      <i class="fa-solid fa-filter fa-lg"></i>Filtrează evenimente
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
          <h1 class="popup-title">Selectează filtre</h1>
          <i class="fa-solid fa-xmark close-button"></i>
          <hr />
        </div>
        <div class="flexhere">
          <!-- judete -->
          <div class="dropdown">
            <div class="select-btn">
              <span class="btn-text" id="btn-text-jud">Selectează judeţe</span>
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
              <span class="btn-text" id="btn-text-fmt">Selectează format</span>
              <span class="arrow-down">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </div>
            <ul class="list-items" id="fmt">
            </ul>
          </div>

          <!-- tip eveniment -->
          <div class="dropdown">
            <div class="select-btn">
              <span class="btn-text" id="btn-text-tip">Selectează tip</span>
              <span class="arrow-down">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </div>
            <ul class="list-items" id="tip">
            </ul>
          </div>
          <center>
            <input type="submit" value="Filtrează" class="submit" />
          </center>
        </div>
      </div>
    </form>
    <script src="../js/eventfilter.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>
