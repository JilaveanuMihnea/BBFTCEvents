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