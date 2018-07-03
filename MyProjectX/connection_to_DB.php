<?php
$servername = "localhost";
$username = "root";
$password = "maxinutrition";
$database_name = "project_X";

$link = new mysqli($servername, $username, $password, $database_name);

if($link -> connect_error){
  header("location:connection_to_DB_error.php?error=$link->connect_error");
  die($link->connect_error);
}

?>
