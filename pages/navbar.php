<div id="obfuscate"></div>
<header id="navbar">
    <div id="otherthing">
      <a href="#" class="menu-bars" id="show-menu">
        <i class="fa-solid fa-bars fa-lg"></i>
      </a>
      <a href="../index.php"><img class="website-logo" src="../resources/img/logo.png"/></a>
    </div>
    
    <div id="thing">
      <a href="pages/eventfilter.php?meet=on&league=on" class="ev-search-link">Evenimente oficiale</a>
      <a href="eventfilter.php" class="ev-search-link">Listă evenimente</a>
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
          <a href="../index.php"><img class="website-logo" src="../resources/img/logo.png"/></a>
        </div>
        <hr />
        <div class="nav-section">
          <!-- add buttons here -->
          <li class="nav-text"><a href="<?php echo $addeventredirect?>"><i class="fa-solid fa-plus nav-icon"></i> Adaugă Eveniment</a> </li>
          <li class="nav-text"><a href="<?php echo $buttonredirect?>"><i class="fa-solid <?php echo $buttonicon ?> nav-icon"></i>
              <?php echo $buttontext ?>
            </a> </li>
          <li class="nav-text"><a href="https://linktr.ee/Brave.Bots" target="_blank"><i class="fa-solid fa-phone nav-icon"></i> Contact</a></li>
          <li class="nav-text"><a href="https://github.com/JilaveanuMihnea/BBFTCEvents/issues/new/choose" target="_blank"><i class="fa-brands fa-github nav-icon"></i> Github</a></li>
        </div>
      </ul>
    </nav>
  </header>