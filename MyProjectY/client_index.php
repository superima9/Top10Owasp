<?php

  require_once "connection_to_DB.php";
  include "verify_auth.php";
  include "check_session.php";
  define('Myheader', TRUE);
  define('mynav', TRUE);
  include "header.php";
  if(isset($_SESSION['loggedIn'])){
    $chesh = $_SESSION['admin'];
    if($chesh === true){
      include "admin_navig_bar.php";
      $log_ids = "store to file";
      session_destroy();
      header("location:index.php?Error=true");
      exit();
    }else{
      include "client_navig_bar.php";
    }
  } else {
    include "navig_bar.php";
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  if(!isset($_SESSION)){
    session_start();
  }

  if(isset($_GET['Error'])){
    $err = "An error occured, sorry for the inconvenience";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['Error_import'])){
    $err = "Please review the format for import input and try again.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['Error_report'])){
    $err = "An error occured, sorry for the inconvenience, we will contact you shortly";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  $id = $_SESSION['userId'];

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($id)))){

    $id = escape_input($id);

  } else {

    $id = FALSE;

  }

  if($id == FALSE){
    $log_ids = "store to a file";
    if(!isset($_SESSION)){
      session_start();
    }
    session_destroy();
    header("location:index.php");
    exit();

  } else {

  //no input from user, session is serverside not clientside like cookies
  $sql = "SELECT firstname, surname, sex FROM client WHERE client_id =".$id;
  $whoami = $link -> query($sql);
  $row = mysqli_fetch_assoc($whoami);
  $title = "Dear";
  if($whoami -> num_rows > 0){

    $sex = $row['sex'];
    $fullname = $row['firstname']." ".$row['surname'];
    if($sex == 'male'){
      $title = "Mister ";
    }else if($sex == 'female'){
      $title = "Miss ";
    }else{
      $title = "Dear ";
    }

  } else {

    //incorrect input
    session_destroy();
    header("location:index.php?loginIncorrect=true");
    $log_ids = "store to file";
    exit();

  }

  $punchline = "Welcome back ".$title." ".$fullname.".";

  $link->close();

  }
?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/client_index_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <div class = "receptacle-init">
      <img src= "./images/panchina.jpg" style="width:100%">
        <div class = "rec-init">
          <h2> <?php echo htmlspecialchars($punchline, ENT_NOQUOTES, "UTF-8"); ?></h2>
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
