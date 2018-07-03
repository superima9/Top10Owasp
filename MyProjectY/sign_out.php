<?php
  require_once "connection_to_DB.php";

  session_start();
  session_destroy();


  header("location:index.php");
  exit();


?>
