<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/event_style.css">
  <title>Add Event</title>
</head>

<body>
  <div class="wrapper">
    <h1>Adaugă un eveniment nou:</h1>
    <form method="post" action="">

      <input name="event_name" type="text" id="e_name" placeholder="Nume eveniment" required /><br><br>

      <textarea name="event_desc" type="text" id="e_desc" cols="30" rows="10" placeholder="Descriere eveniment"
        required></textarea><br><br>

      <label for="e-img">Adaugă o imagine reprezentativă pentru eveniment:</label><br>
      <input name="event_img" type="file" id="e_img" accept=".png,.jpg,.jpeg" required /><br><br>

      <label for="e_time">Alege data și ora la care începe evenimentul:</label><br>
      <input name="event_time" type="datetime-local" id="e_time" required /><br><br>

      <label for="e_location">Alege locația evenimentului:</label><br>
      <input name="event_location" type="text" id="e_location" required /> <br><br>
      <center><input type="submit" id="button" value="Add event" /></center>
    </form>
  </div>

</body>

</html>