<?php

$con = mysqli_connect("localhost","novo","password","controleprocessos");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

