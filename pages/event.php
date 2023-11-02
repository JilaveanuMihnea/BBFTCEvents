<!-- <?php
session_start();
// echo $_SESSION['ftcevents_teamid'];
include("../classes/login.php");
include("../classes/connect.php");

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


?> -->

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

    <link
      rel="stylesheet"
      href="../style/event.css"
    />
  </head>

  <body>
    <!-- navbar + sidemenu -->
    <!-- <div id="obfuscate"></div>
  <header id="navbar">
    <a href="#" class="menu-bars" id="show-menu">
      <i class="fa-solid fa-bars fa-lg"></i>
    </a>
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
          <li class="nav-text"><a href="<?php echo $addeventredirect?>"><i class="fa-solid fa-plus nav-icon"></i> Adauga Eveniment</a></li>
          <li class="nav-text"><a href="<?php echo $buttonredirect?>"><i class="fa-solid <?php echo $buttonicon ?> nav-icon"></i>
              <?php echo $buttontext ?>
            </a></li>
        </div>
      </ul>
    </nav>
  </header>
   -->

    <!-- <div class="top-container">
      <div class="top-left">
        <h1>Eveniment</h1>
        <a
          class="subtitle"
          href=""
          >Locatie</a
        >
        <p class="paragraph">locatia</p>
        <p class="subtitle">Echipe org</p>
        <a
          href=""
          class="paragraph"
          >Echipa 1</a
        >
        <a
          href=""
          class="paragraph"
          >Echipa 2</a
        >
        <p class="subtitle">Ziua si ora</p>
        <p class="paragraph">Maine</p>
      </div>
      <div class="top-right">
        <img
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXst5Nezg9yJP0tgH1VCKmu7-9KnSjrExac0S4OiP54dsqaLvj-SjR&usqp=CAE&s"
          alt="o poza cu evenimentul"
        />
      </div>
    </div>
    <div class="bot-container">
      <h1>Descriere</h1>
      <div class="descriere">
        <p>
          This integer attribute indicates the current ordinal value of the list
          item as defined by the element. The only allowed value for this
          attribute is a number, even if the list is displayed with Roman
          numerals or letters. List items that follow this one continue
          numbering from the value set. The value attribute has no meaning for
          unordered lists or for menus.
        </p>
      </div>
    </div> -->
  </body>
</html>
