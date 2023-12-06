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

  if(isset($_POST['kill']) && $_POST['kill']){
    //insure correct login
    $evgetter = new Event();
    $event_data = $evgetter->get_event($_POST['kill']);
    if(isset($_SESSION['team_number']) && is_numeric($_SESSION['team_number'])){
      if($_SESSION['team_number']==$event_data[0]['team_number']){
        //pyhton script to delte from json
        shell_exec('python ../control/requesteventdelete.py ' .$_POST['kill']);
        
        //delete from db
        $ev = new Event();
        $ev->delete_event($_POST['kill']);
      }
    }
    header("Location: ../index.php");
    die;
  }else{
    $evgetter = new Event();
    $event_data = $evgetter->get_event($_GET['id']);
    if(!$event_data){
      header("Location: ../index.php");
      die;
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $event_data[0]['event_name']?></title>
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
    <link rel="stylesheet" type="text/css" href="../style/eventshowcase.css" />
  </head>
  <body>
    
    <?php include("navbar.php") ?>

    <?php
      if(isset($_SESSION['team_number']) && is_numeric($_SESSION['team_number'])){
        if($_SESSION['team_number']==$event_data[0]['team_number']){
          echo  '<center><button id="delbtn"><i class="fa-solid fa-trash"></i> Şterge eveniment</button></center>
                <center><a href="eventedit.php?id='. $event_data[0]['eventid'] .'"><button id="editbtn"><i class="fa-solid fa-gear"></i> Modifică eveniment</button></a></center>
                <div class="delete-form">
                  <i class="fa-solid fa-xmark" id="closebtn"></i>
                  <form method="post" action="">
                    <p>Confirmă ştergerea evenimentului</p>
                    <input type="hidden" value="' .  $event_data[0]['eventid'] . ' " name="kill">
                    <input type="submit" value="Şterge eveniment">
                  </form>
                </div>';
        }
      }
    ?>

    <div class="main-container">
      <h1><?php echo $event_data[0]['event_name']?></h1>
      <div class="top-section">
        <div class="img-div">
          <img src="<?php echo $event_data[0]['event_img']?>" class="event-img" />
        </div>
        <ul class="event-details">
          <li>
            Organizat de: <br />
            <p><a href="team.php?nb=<?php echo $event_data[0]['team_number']?>"><?php echo $event_data[0]['team_name']?></a></p>
          </li>
          <li>
            Data si ora eveniment: <br />
            <p><?php echo $event_data[0]['event_time']?></p>
          </li>
          <li>
            Format eveniment: <br />
            <p>
              <?php
                if($event_data[0]['event_format']=='fiz'){
                  echo 'Fizic';
                }else{
                  echo 'Online';
                }
              ?>
            </p>
          </li>
          <li>
            Tip eveniment: <br />
            <p>
              <?php
                echo strtoupper($event_data[0]['event_type'][0]) . substr($event_data[0]['event_type'], 1);
              ?>
            </p>
          </li>
          
          <?php
            if($event_data[0]['event_format']=='fiz'){
              echo '<li>
                      Locatie eveniment: <br />
                      <p>' . $event_data[0]['event_location'] .'</p>
                    </li>';
            }
          ?>
          <li>
              <a href="<?php echo $event_data[0]['team_contact']?>" target="_blank">
              Contact Echipa <i class="fa-solid fa-phone-flip "></i> 
              </a>
          </li>
        </ul>
      </div>
      <div class="description">
        <p>
          &emsp;<?php echo $event_data[0]['event_desc']?>
        </p>
      </div>
    </div>
    <script src="../js/script.js"></script>
    <script src="../js/eventshowcase.js"></script>
  </body>
</html>
