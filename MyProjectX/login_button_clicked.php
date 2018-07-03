<?php
  include "connection_to_DB.php";

  if(!isset($_SESSION)){
    session_start();
  }


  $user =  $_POST["client_username"];
  $pwd = $_POST["client_password"];

  if($user != "admin"){
    $sql_req = "SELECT * FROM client WHERE username = '".$user."'AND password = '".$pwd."'";

    $query_login = $link->query($sql_req);
    $row = $query_login->fetch_assoc();

    if($query_login-> num_rows > 0){
      $_SESSION['admin'] = false;
      $_SESSION['loggedIn'] = true;
      $_SESSION['userId'] = $row["client_id"];
      $_SESSION['LAST_ACTIVITY'] = time();
      header("location:client_index.php");
    }else{
      session_destroy();
      die(header("location:indexx.php?loginFailed=true"));
    }
  }else{
    $sql_req = "SELECT * FROM admin WHERE username = '".$user."'AND password = '".$pwd."'";

    $query_login = $link->query($sql_req);

    $row = $query_login->fetch_assoc();

    if($query_login-> num_rows > 0){
      $_SESSION['admin'] = true;
      $_SESSION['loggedIn'] = true;
      $_SESSION['userId'] = $row["admin_id"];
      $_SESSION['LAST_ACTIVITY'] = time();
      header("location:admin_index.php");
    }else{
      session_destroy();
      die(header("location:indexx.php?loginFailed=true"));
    }

  }
?>
