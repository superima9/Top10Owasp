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

  if(isset($_GET['Error_import'])){
    $err = "Please review the format for import input and try again.";
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
  <link rel = "stylesheet" href = "./css/client_atm_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <form accept-charset="utf-8" class = "atm_form" action = "check_atm_form.php" method = "post" autocomplete="off">
      <div class = "title">
        <h3>Welcome to the Atm</h3>
      </div>
      <div class = "receptacle-init">
        <div class = "rec-init">
          <label>Please enter import: &pound</label>
          <input name = "import" placeholder="00.00" size = "10" maxlength="10" type = "text" required>
        </div>
      </div>
      <div class = "receptacle-init">
        <div class = "rec-init">
          <label>Please enter your Pin Digit: </label>
          <input name = "pin" size = "10" maxlength="10" type = "password" required>
        </div>
      </div>
      <div class = "receptacle-init">
        <div class = "rec-init">
          <button class = "button" type = "submit">Withdraw</button>
          <a href = "client_transfers.php" class = "button">Cancel</a>
        </div>
      </div>
    </form>
  </div>
  <footer>
    <div class ="Copyright">
      <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
      <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
    </div>
  </footer>
</body>
</html>
