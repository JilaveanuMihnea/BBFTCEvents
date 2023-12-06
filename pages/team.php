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
    <title><?php echo $teamdata[0]['team_name']?></title>
    <link rel="icon"  href="../resources/img/favicon.png">
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

    <?php include("navbar.php") ?>
    
    <div class="main-container">
      <?php
        if(isset($_SESSION['team_number']) && is_numeric($_SESSION['team_number'])){
          if($_SESSION['team_number']==$teamdata[0]['team_number']){
            echo '<center><a href="teamedit.php?nb='. $teamdata[0]['team_number'] .'"><button id="editbtn"><i class="fa-solid fa-gear"></i> Setări cont</button></a></center>';
          }
        }
      ?>
      <div class="team-info">
        <div class="profile-img"><img src="../data/teamimgs/<?php echo $teamdata[0]['team_number']?>.png" /></div>
        <div class="team-text">
          <div class="team-name">
            <h1><?php echo $teamdata[0]['team_name']?><br /><?php echo $teamdata[0]['team_number']?></h1>
          </div>
          <div class="team-bio"><?php echo $teamdata[0]['team_bio']?></div>
          <div class="team-contact">
            <a href="<?php echo $teamdata[0]['team_contact']?>" target="_blank"><i class="fa-solid fa-phone-flip fa-lg"></i></a>
          </div>
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
          }else{
            echo '<center>';
            echo "Niciun eveniment :(";
            echo '</center>';
          }
        ?>
      </div>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
