<?php
session_start();
include("../classes/allclasses.php");


$buttontext = "Conectează-te";
$buttonicon = "fa-right-to-bracket";
$buttonredirect = "login.php";
$addeventredirect = "login.php";


$evgetter = new Event();
$event_data = $evgetter->get_event($_GET['id']);
if(!$event_data){
  header("Location: ../index.php");
  die;
}
if(isset($_SESSION['team_number']) && is_numeric($_SESSION['team_number'])){
  if($_SESSION['team_number']==$event_data[0]['team_number']){
    $buttontext = "Deconectează-te";
    $buttonicon = "fa-right-from-bracket";
    $buttonredirect = 'logout.php';
    $addeventredirect = 'eventadd.php';
    $is_logged = true;
  }else{
    header("Location: ../index.php");
    die;
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //todo sql query to edit event
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Event</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/922eec37ec.js" crossorigin="anonymous"></script>

  <script src="../js/autocomplete.js"></script>

  <link rel="stylesheet" type="text/css" href="../style/style.css">
  <link rel="stylesheet" type="text/css" href="../style/eventedit.css">

</head>

<body>
  <!-- navbar + sidemenu -->
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

  <div class="dom-target">
    <div id="judet"><?php echo $event_data[0]['event_jud']?></div>
    <div id="typ"><?php echo $event_data[0]['event_type']?></div>
  </div>

  <div class="main-container">
    <div class="title-section">
      <h1>Modifica Evenimentul</h1>
      <hr />
    </div>
    <form
      method="post"
      enctype="multipart/form-data"
      action=""
      class="form-section"
      autocomplete="off"
    >
      <input
        class="text"
        name="event_name"
        type="text"
        id="e_name"
        placeholder="Nume eveniment"
        value="<?php echo $event_data[0]['event_name']?>"
        required
      />
      <br />
      <br />

      <div class="dropdowns">
        <select name="event_format" id="fmt" required>
          <option value="">Alege format</option>
          <option value="onl" <?php if($event_data[0]['event_format']=="onl") echo "selected"?>>Online</option>
          <option value="fiz" <?php if($event_data[0]['event_format']=="fiz") echo "selected"?>>Fizic</option>
        </select>
        <select name="event_type" id="tip" required>
          <option value="">Alege tip</option>
        </select>
        <select name="event_jud" id="jud" required>
          <option value="">Alege judet</option>
        </select>
      </div>
      <br />
      <br />
      <center><p>Pentru ca evenimentul sa apara pe harta, alegeti o locatie predefinita</p></center>
      <input
        class="text"
        name="event_location"
        type="text"
        id="e_location"
        placeholder="Introdu o locatie"
      />
      
      <br />
      <br />
      <input
        class="datetime"
        name="event_time"
        type="datetime-local"
        id="e_time"
        max="9999-12-31T12:59"
        value="<?php echo $event_data[0]['event_time']?>"
        required
      />
      <br />
      <br />
      <label for="e_img" class="custom-upload">
        <span id="crazy">Incarca o imagine</span>
      </label>
      <input
        class="img"
        name="event_img"
        type="file"
        id="e_img"
        accept=".png,.jpg,.jpeg"
        required
      />
      <br />
      <br />
      <textarea
        class="text"
        name="event_desc"
        type="text"
        id="e_desc"
        maxlength="900"
        placeholder="Descriere"
        required
      ><?php echo $event_data[0]['event_desc']?></textarea>
      <br />
      <br />
      <center>
        <input type="submit" id="button" value="Add event" class="submit" />
      </center>
      <input name="event_lat" type="hidden" id="e_lat" />
      <input name="event_lng" type="hidden" id="e_lng" />
    </form>
  </div>

  <script src="../js/eventedit.js"></script>
  <script src="../js/script.js"></script>
  <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByIrjtaUZVRpacy8BFWLoHpmFpDhu_RUk&libraries=places&callback=initMap">
    </script>
</body>

</html>