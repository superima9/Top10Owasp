<?php
  ini_set('session.cookie_httponly', 1);
  if(!isset($_SESSION)){
    session_start();
  }

  if(!isset($_SESSION['loggedIn'])){
    header("location:index.php");
    exit();
  }
?>
