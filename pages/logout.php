<?php

session_start();
unset($_SESSION['ftcevents_teamid']);
header("Location: ../index.php");

?>