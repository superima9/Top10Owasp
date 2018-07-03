<?php
  require_once "connection_to_DB.php";
  define('Myheader', TRUE);
  define('mynav', TRUE);
  include "header.php";
  include "verify_auth.php";
  include "check_session.php";

  if(isset($_SESSION['loggedIn'])){
    $chesh = $_SESSION['admin'];
    if($chesh === true){
      include "admin_navig_bar.php";
    }else{
      include "client_navig_bar.php";
      $log_ids = "store to file";
      session_destroy();
      header("location:index.php?Error=true");
      exit();
    }
  } else {
    include "navig_bar.php";
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  $admin_id = $_SESSION['userId'];

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($admin_id)))){

    $admin_id = escape_input($admin_id);

  } else {

    $admin_id = FALSE;

  }

  if($admin_id == FALSE){
    $log_ids = "High priority";
  }

  if(isset($_GET['IncorrectToken'])){
    $err = "Please review the format for the input fields and try again.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['Error'])){
    $err = "An error occured, sorry for the inconvenience";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }
  ?>
  <?php header("Content-Type: text/html; charset=utf-8"); ?>


<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_index_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <div class = "receptacle-init">
      <img src= "./images/handshacke.jpeg" style="width:100%">
        <div class = "rec-init">
          <h2> <?php echo htmlspecialchars("HELLO ADMIN", ENT_NOQUOTES, "UTF-8"); ?></h2>
        </div>
    </div>
  </div>
  <footer>
    <div class ="Copyright">
      <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
      <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
    </div>
  </footer>
</body>
</html>
