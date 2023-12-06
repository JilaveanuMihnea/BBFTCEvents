<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method="post" action="">
    <select name="tip" required>
      <option value="">workshop</option>
      <option value="demo">demo</option>
    </select>
    <input type="submit" value="submit">
  </form>
</body>
</html>

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