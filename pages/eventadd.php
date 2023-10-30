<?php
//todo implement image upload
session_start();
include("../classes/connect.php");
include("../classes/eventadd.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $event = new Event();
  $result = $event->evaluate($_POST, $_SESSION['teamid']);
  if ($result) {
    echo $result;
  }
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";

  // $event = $_POST;
  // $event['teamid'] = $_SESSION['teamid'];
  // //!write data to jsonfile
  // $filename = '../data/markers.json';
  // // read the file if present
  // $handle = @fopen($filename, 'r+');

  // // create the file if needed
  // if ($handle === null) {
  //   $handle = fopen($filename, 'w+');
  // }

  // if ($handle) {
  //   // seek to the end
  //   fseek($handle, 0, SEEK_END);

  //   // are we at the end of is the file empty
  //   if (ftell($handle) > 0) {
  //     // move back a byte
  //     fseek($handle, -1, SEEK_END);

  //     // add the trailing comma
  //     fwrite($handle, ',', 1);

  //     // add the new json string
  //     fwrite($handle, json_encode($event) . ']');
  //   } else {
  //     // write the first event inside an array
  //     fwrite($handle, json_encode(array($event)));
  //   }

  //   // close the handle on the file
  //   fclose($handle);
  // }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/event_style.css">
  <title>Add Event</title>
  <script src="../js/autocomplete.js"></script>
</head>

<body>
  <div class="wrapper">
    <h1>Adaugă un eveniment nou:</h1>
    <form method="post" action="">

      <input name="event_name" type="text" id="e_name" placeholder="Nume eveniment" required /><br><br>

      <textarea name="event_desc" type="text" id="e_desc" cols="30" rows="10" placeholder="Descriere eveniment"
        required></textarea><br><br>

      <label for="e-img">Adaugă o imagine reprezentativă pentru eveniment:</label><br>
      <input name="event_img" type="file" id="e_img" accept=".png,.jpg,.jpeg" /><br><br>

      <label for="e_time">Alege data și ora la care începe evenimentul:</label><br>
      <input name="event_time" type="datetime-local" id="e_time" required /><br><br>

      <label for="e_location">Alege locația evenimentului:</label><br>
      <input name="event_location" type="text" id="e_location" required /> <br><br>
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