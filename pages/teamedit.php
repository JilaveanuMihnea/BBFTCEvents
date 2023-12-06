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

$td = new Database();
$quick = $_GET['nb'];
$query = "select * from users where team_number = '$quick' limit 1";
$teamdata = $td->read($query);
if(!$teamdata){
  header("Location: ../index.php");
  die;
}

if(isset($_SESSION['team_number']) && is_numeric($_SESSION['team_number'])){
  if($_SESSION['team_number']==$teamdata[0]['team_number']){
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
  $teameditor = new Team();
  $result = $teameditor->team_update($_POST, $_SESSION['team_number']);

  if($_FILES['team_img']['tmp_name']){
    $imgname = "../data/teamimgs/" . $_SESSION['team_number'] . ".png";
    move_uploaded_file($_FILES['team_img']['tmp_name'], $imgname);

    $image = new Image();
    $image->crop_image($imgname, $imgname, 800, 800);
  }
  
  if($result){
    echo '<center>';
    echo $result;
    echo '</center>';
  }else{
    header("Location: team.php?nb=" . $_SESSION['team_number']);
    die;
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setări cont</title>

  <link rel="icon"  href="../resources/img/favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/922eec37ec.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="../style/style.css">
  <link rel="stylesheet" type="text/css" href="../style/teamedit.css">
</head>
<body>
  <?php include('navbar.php') ?>

  <div class="main-container">
    <div class="title-section">
      <h1>Setări cont</h1>
      <hr />
    </div>
    <form
      method="post"
      enctype="multipart/form-data"
      action=""
      class="form-section"
      autocomplete="off"
    >
    <textarea
        class="text"
        name="team_bio"
        type="text"
        id="team_bio"
        maxlength="900"
        placeholder="Descriere echipă"
      ><?php echo $teamdata[0]['team_bio']?></textarea>
      <br />
      <br />
      <input
        class="text"
        name="team_contact"
        type="text"
        id="t_contact"
        placeholder="Contact echipă (link)"
        value="<?php echo $teamdata[0]['team_contact']?>"
        required
      />
      <br />
      <br />
      <label for="team_img" class="custom-upload">
        <span id="crazy">Încarca o imagine</span>
      </label>
      <input
        class="img"
        name="team_img"
        type="file"
        id="team_img"
        accept=".png,.jpg,.jpeg"
      />
      <br />
      <br />
      <center>Lăsaţi câmpurile libere pentru a pastra detaliile de logare curente</center>
      <input
        class="text"
        name="team_login"
        type="text"
        id="t_login"
        placeholder="Nume uitilizator"
      />
      <br />
      <input
        class="text"
        name="team_login_conf"
        type="text"
        id="t_login_conf"
        placeholder="Confirmare nume utilizator"
      />
      <br />
      <br />
      <input
        class="text"
        name="password"
        type="password"
        id="t_pass"
        placeholder="Parolă"
      />
      <br />
      <input
        class="text"
        name="password_conf"
        type="text"
        id="t_pass_conf"
        placeholder="Confirmare parolă"
      />
      <br />
      <br />
      <center>
        <input type="submit" id="button" value="Aplică schimbările" class="submit" />
      </center>
    </form>
  </div>

  <script src="../js/script.js"></script>
  <script src="../js/teamedit.js"></script>
</body>
</html>