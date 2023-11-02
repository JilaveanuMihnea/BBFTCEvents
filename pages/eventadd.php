<?php
session_start();
include("../classes/connect.php");
include("../classes/eventadd.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  //generate file name
  $length = rand(10, 19);
  $filename = "";
  for ($i = 0; $i < $length; $i++) {
    $new_rand = rand(0, 9);
    $filename .= $new_rand;
  }

  //check data, add to db if valid
  $_POST['eventid'] = $filename;
  $filename = "../data/eventimgs/" . $filename . ".png";
  $_POST['event_img'] = $filename;
  $event = new Event();
  $result = $event->evaluate($_POST, $_SESSION['teamid']);

  if ($result) {

    //echo any input errors
    echo $result;

  } else {

    //write marker data to jsonfile
    move_uploaded_file($_FILES['event_img']['tmp_name'], $filename);
    $event = $_POST;
    $event['teamid'] = $_SESSION['teamid'];
    $event['event_img'] = "../data/eventimgs/" . $filename;


    $filename = '../data/markers.json';
    // read the file if present
    $handle = @fopen($filename, 'r+');

    // create the file if needed
    if ($handle === null) {
      $handle = fopen($filename, 'w+');
    }

    if ($handle) {
      // seek to the end
      fseek($handle, 0, SEEK_END);

      // are we at the end of is the file empty
      if (ftell($handle) > 0) {
        // move back a byte
        fseek($handle, -1, SEEK_END);

        // add the trailing comma
        fwrite($handle, ',', 1);

        // add the new json string
        fwrite($handle, json_encode($event) . ']');
      } else {
        // write the first event inside an array
        fwrite($handle, json_encode(array($event)));
      }

      // close the handle on the file
      fclose($handle);
    }
  }


}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/event_style.css">
  <title>Add Event</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap" rel="stylesheet">

  <script src="../js/autocomplete.js"></script>

</head>

<body>
  <div class="wrapper">
    <h1>Adaugă un eveniment nou:</h1>
    <form method="post" enctype="multipart/form-data" action="">

      <input name="event_name" type="text" id="e_name" placeholder="Nume eveniment" /><br><br>

      <textarea name="event_desc" type="text" id="e_desc" cols="30" rows="10"
        placeholder="Descriere eveniment"></textarea><br><br>

      <label for="e-img">Adaugă o imagine reprezentativă pentru eveniment:</label><br>
      <input name="event_img" type="file" id="e_img" accept=".png,.jpg,.jpeg" /><br><br>

      <label for="e_time">Alege data și ora la care începe evenimentul:</label><br>
      <input name="event_time" type="datetime-local" id="e_time" /><br><br>

      <label for="e_location">Alege locația evenimentului:</label><br>
      <input name="event_location" type="text" id="e_location" /> <br><br>
      <center><input type="submit" id="button" value="Add event" /></center>
      <input name="event_lat" type="hidden" id="e_lat" />
      <input name="event_lng" type="hidden" id="e_lng" />
    </form>
  </div>


  <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByIrjtaUZVRpacy8BFWLoHpmFpDhu_RUk&libraries=places&callback=initMap">
    </script>
</body>

</html>