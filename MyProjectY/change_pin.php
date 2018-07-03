<?php

  require_once "connection_to_DB.php";
  include "verify_auth.php";
  include "check_session.php";
  define('mynav', TRUE);
  define('Myheader', TRUE);
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

  if(isset($_GET['IncorrectToken'])){
    $err = "Please enter a valid pin.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['Error'])){
    $err = "Something went wrong. Please try again later.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  $client_id = $_SESSION['userId'];
?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/change_pwd_layout.css">
</head>
<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
      <div class = "rec-init-1">
        <form accept-charset="utf-8" action = "change_credentials.php?ibgs=7375" class = "client_form" method = "post" autocomplete="off"> <!--*****-->
          <div class = "receptacle-title">
            <h2>Change Pin of your bank account</h2>
          </div>
          <div class=rec-init>
              <label>Enter old pin :</b></label><br>
              <input name="old-pin" size="10" type="password" required>
          </div>
          <div class= "rec-init">
              <label>Enter new pin :</label><br>
              <input name="new-pin" size="10" type="password" required>
          </div>
          <div  class= "rec-init">
              <label>Re-enter new pin :</b></label><br>
              <input name="new-pin-2" size="10" type="password" required>
          </div>
          <div id = "btn" class="rec-init">
            <a href="client_my_account.php" class="button">Back</a>
          </div>
          <div class="rec-init">
            <button class = "button" type="submit">Submit</button>
          </div>
        </form>
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
