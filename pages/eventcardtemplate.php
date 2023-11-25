<a href="eventshowcase.php?id=<?php echo $row['eventid']?>">
  <div class="event-container">
    <div class="event-img-container">
      <img src="<?php echo $row['event_img']?>" class="event-img" />
    </div>
    <div class="event-text-container">
      <h1 class="event-name"><?php echo $row['event_name']?></h1>
      <ul class="event-details">
        <li><i class="fa-solid fa-users"></i> <?php echo $row['team_name']?></li>
        <li><i class="fa-solid fa-clock"></i> <?php echo $row['event_time']?></li>
        <li><i class="fa-solid fa-<?php if($row['event_format']=='onl'){
            echo 'wifi';
          }else{
            echo 'earth-europe';
          }?>"></i> 
        <?php 
          if($row['event_format']=='onl'){
            echo 'Online';
          }else{
            echo 'Fizic';
          }
        ?>
        </li>
        <li><i class="fa-solid fa-robot"></i> <?php echo strtoupper($row['event_type'][0]) . substr($row['event_type'], 1);?></li>
        <?php
          if($row['event_format']=='fiz'){
            echo '<li>
                    <i class="fa-solid fa-map-location-dot"></i> ' .
                    $row['event_location'] .
                  '</li>';
          }
        ?>
        
      </ul>
    </div>
  </div>
</a>