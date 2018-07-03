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


  $client_id = $_SESSION['userId'];

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

    $client_id = escape_input($client_id);

  } else {

    $client_id = FALSE;

  }

  if($client_id == FALSE){
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  if(!empty($_GET['rcv'])){
    include_once "encrypt.php";
    $receiver = encrypt('decrypt', $_GET['rcv']);
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($receiver)))){
      $receiver = escape_input($receiver);

    } else {

      $receiver = FALSE;

    }
  } else {

    $receiver = FALSE;

  }

  if($receiver == FALSE){
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  } else {

    //verified input already
    $sql0 = "DELETE FROM beneficiary_c".$client_id." WHERE account_num = '".$receiver."'";
    $message = "ciao";

    if(($link -> query($sql0) === TRUE)){
      $message = "Deleted the recipient successfully";
    } else{
      $message = "A problem occured, try again leter";
    }
    mysqli_close($link);
  }
?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/del_recipient_layout.css">
</head>

<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <h3><?php echo htmlspecialchars($message, ENT_NOQUOTES, "UTF-8");?></h3>
    </div>

    <div class = "rec-init">
      <a id = "a" href = "client_index.php" class = "button">Home Page</a>
      <a href = "client_transfers.php" class = "button">Payment and transfers</a>
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
