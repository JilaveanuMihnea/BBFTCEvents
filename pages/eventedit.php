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
  $eveditor = new Event();
  $eveditor->update_event($_POST);
  

  if($_FILES['event_img']['tmp_name']){
    $imgname = "../data/eventimgs/" . $_POST['id'] . ".png";
    move_uploaded_file($_FILES['event_img']['tmp_name'], "../data/eventimgs/" . $_POST['id'] . ".png");
  
    $image = new Image();
    $image->crop_image($imgname, $imgname, 800, 800);
  }

  //todo python script to remove/add/update from markers.json
  echo "<pre>";
  echo print_r($_POST);
  echo "</pre>";
  echo shell_exec('python ../control/updateevent.py ' . $_POST['id'] . ' ' . escapeshellarg($_POST['event_name']) . ' ' . escapeshellarg($_POST['event_location']) . ' ' . escapeshellarg($_POST['event_time']) . ' ' . escapeshellarg($_POST['event_lat']) . ' ' . escapeshellarg($_POST['event_lng']));


  header("Location: eventshowcase.php?id=" . $_POST['id']);
  die;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifică Eveniment</title>
  <link rel="icon"  href="../resources/img/favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/922eec37ec.js" crossorigin="anonymous"></script>

  <script src="../js/autocomplete.js"></script>

  <link rel="stylesheet" type="text/css" href="../style/style.css">
  <link rel="stylesheet" type="text/css" href="../style/eventedit.css">

</head>

<body>

  <?php include("navbar.php") ?>

  <div class="dom-target">
    <div id="judet"><?php echo $event_data[0]['event_jud']?></div>
    <div id="typ"><?php echo $event_data[0]['event_type']?></div>
  </div>

  <div class="main-container">
    <div class="title-section">
      <h1>Modifică Evenimentul</h1>
      <hr />
    </div>
    <form
      method="post"
      enctype="multipart/form-data"
      action=""
      class="form-section"
      autocomplete="off"
    >
      <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
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
          <option value="">Alege judeţ</option>
        </select>
      </div>
      <br />
      <br />
      <center><p>Pentru ca evenimentul să apară pe hartă, alegeţi o locaţie predefinită</p></center>
      <input
        class="text"
        name="event_location"
        type="text"
        id="e_location"
        placeholder="Introduceţi o locaţie"
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
        <span id="crazy">Încarca o imagine</span>
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
        placeholder="Descriere eveniment"
        required
      ><?php echo $event_data[0]['event_desc']?></textarea>
      <br />
      <br />
      <center>
        <input type="submit" id="button" value="Aplică modificările" class="submit" />
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