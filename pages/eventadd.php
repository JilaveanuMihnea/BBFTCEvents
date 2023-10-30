<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

}
echo "<pre>";
print_r($_POST);
echo "</pre";





// //write data to jsonfile
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Add</title>
  <script src="../js/autocomplete.js"></script>
</head>

<body>

  <form method="post" action="">
    <input name="event_name" type="text" id="e_name" placeholder="Nume eveniment" /><br><br>
    <input name="event_desc" type="text" id="e_desc" placeholder="Descriere eveniment" /><br><br>
    <input name="event_img" type="file" id="e_img" accept=".png,.jpg,.jpeg" /><br><br>
    <input name="event_time" type="time" id="e_time" /><br><br>

    <input name="event_location" type="text" id="pac-input" /> <br><br>
    <input name="event_lat" type="hidden" id="e_lat" />
    <input name="event_lng" type="hidden" id="e_lng" />
    <input type="submit" id="button" value="Add event" />

  </form>


  <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByIrjtaUZVRpacy8BFWLoHpmFpDhu_RUk&libraries=places&callback=initMap">
    </script>
</body>

</html>