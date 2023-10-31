<?php
  @$db = new mysqli('localhost', 'root', '', 'dental_clinic');
  if (mysqli_connect_errno()) {
    echo 'Error: could not connect to database. Please try again.';
    exit;
  }
  // else
  // {
  //   echo "Connection to MySQL is established!";
  // }
?>
