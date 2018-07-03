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



  if(isset($_GET['IncorrectToken'])){
    $err = "Please enter a valid password.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }
  if(isset($_GET['Error'])){
    $err = "Something went wrong. Please try again later.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(!empty($_GET['clt'])){
    if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($_GET['clt'])))){
      $client_id = escape_input($_GET['clt']);
    } else {
      $client_id = FALSE;
    }
  } else {
    $client_id = FALSE;
  }

  if($client_id == FALSE){
    header("location:admin_manage_client.php");
  }

  $admin_id = $_SESSION['userId'];

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($admin_id)))){
      $admin_id = escape_input($admin_id);
  } else {
      $admin_id = FALSE;
  }

  if($admin_id == FALSE){
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }
?>

<?php header("Content-Type: text/html; charset=utf-8"); ?>


<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_change_pwd_layout.css">
</head>
<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
    </div>

    <div class = "receptacle-init">
      <div class = "rec-init-1">
        <form accept-charset="utf-8" action = "admin_change_credentials.php?ibgs=5393&clt=<?php echo $client_id?>" class = "client_form" method = "post" autocomplete="off"> <!--*****-->
          <div class = "receptacle-title">
            <h2>Change PAN number of client bank account</h2>
          </div>

          <div class=rec-init>
              <label>Enter your admin password :</b></label><br>
              <input name="admin-pwd" size="35" maxlength="35" type="password" required />
          </div>
          <div class= "rec-init">
              <label>Enter new PAN :</label><br>
              <input name="new-pan" size="16" maxlength="16" type="text" required />
          </div>

          <div  class= "rec-init">
              <label>Re-enter new PAN :</b></label><br>
              <input name="new-pan-2" size="16" maxlength="16" type="text" required />
          </div>

          <div id = "btn" class="rec-init">
            <a href="admin_manage_client.php" class="button">Back</a>
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
