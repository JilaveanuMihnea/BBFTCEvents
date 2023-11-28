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
    //todo check if id exists
    $evgetter = new Event();
    $event_data = $evgetter->get_event($_GET['id']);
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $event_data[0]['event_name']?></title>

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
    
    <?php
      if(isset($_SESSION['team_number']) && is_numeric($_SESSION['team_number'])){
        if($_SESSION['team_number']==$event_data[0]['team_number']){
          echo  '<center><button id="delbtn"><i class="fa-solid fa-trash"></i> Sterge eveniment</button></center>
                <div class="delete-form">
                  <i class="fa-solid fa-xmark" id="closebtn"></i>
                  <form method="post" action="">
                    <p>Confirma stergerea evenimentului</p>
                    <input type="hidden" value="' .  $event_data[0]['eventid'] . ' " name="kill">
                    <input type="submit" value="Sterge eveniment">
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
