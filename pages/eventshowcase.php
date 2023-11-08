<?php
  session_start();  
  include("../classes/allclasses.php");

  $evgetter = new Event();
  $event_data = $evgetter->get_event($_GET['id']);
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
    <div class="navbar-sim"></div>

    <!-- <center><button>Sterge eveniment</button></center> -->

    <div class="main-container">
      <h1><?php echo $event_data[0]['event_name']?></h1>
      <div class="top-section">
        <div class="img-div">
          <img src="<?php echo $event_data[0]['event_img']?>" class="event-img" />
        </div>
        <ul class="event-details">
          <li>
            Organizat de: <br />
            <p><?php echo $event_data[0]['team_name']?></p>
          </li>
          <li>
            Locatie eveniment: <br />
            <p><?php echo $event_data[0]['event_location']?></p>
          </li>
          <li>
            Data si ora eveniment: <br />
            <p><?php echo $event_data[0]['event_time']?></p>
          </li>
          <li>
            Format eveniment: <br />
            <p><?php echo $event_data[0]['event_format']?></p>
          </li>
          <li>
            Tip eveniment: <br />
            <p><?php echo $event_data[0]['event_type']?></p>
          </li>
        </ul>
      </div>
      <div class="description">
        <p>
          &emsp;<?php echo $event_data[0]['event_desc']?>
        </p>
      </div>
    </div>
  </body>
</html>
