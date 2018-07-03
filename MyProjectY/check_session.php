<?php
  require_once "connection_to_DB.php";

  $timeout = 60*5;

  if(isset($_SESSION['LAST_ACTIVITY'])){
    $duration = time() - (int)$_SESSION['LAST_ACTIVITY'];
    if($duration > $timeout){
      session_destroy();
      header("location:session_expired.php");
      exit();
    } else {

    }
  }

  $_SESSION['LAST_ACTIVITY'] = time();
?>
