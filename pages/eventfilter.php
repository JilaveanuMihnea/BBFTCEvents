<?php
  session_start();
  include("../classes/allclasses.php");

  echo "<pre>";
  print_r($_GET);

  echo "</pre>";

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



  if($_GET){
    $event = new Event();
    $event->get_events($_GET);
  }


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
    <div class="navbar-sim"></div>

    <div id="show-filters">
      <i class="fa-solid fa-filter fa-lg"></i>Filtreaza evenimente
    </div>
    <hr />

    <div class="main-container">
      <?php

        include("eventcardtemplate.php");
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
  </body>
</html>
