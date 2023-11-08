<?php
  session_start();
  include("../classes/allclasses.php");


  $evgetter = new Event();
  $events = $evgetter->get_team_events($_SESSION['team_number']);


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
    <div class="navbar-sim"></div>
    <div class="main-container">
      <div class="team-info">
        <div class="profile-img">
          <img src="../data/eventimgs/343451851501.png" />
        </div>
        <div class="team-text">
          <div class="team-name">
            <h1>BraveBots<br />19141</h1>
          </div>
          <div class="team-bio">echipa care care</div>
        </div>
      </div>
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
  </body>
</html>
