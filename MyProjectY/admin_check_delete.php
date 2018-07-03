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


  if(!empty($_GET['clt'])){
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($_GET['clt'])))){

      $account_num = escape_input($_GET['clt']);

    } else {

      $account_num = FALSE;

    }
  } else {

    $account_num = FALSE;

  }

  if($account_num == FALSE){
    header("location:admin_index.php?Error=true");
    exit();
  }
?>

<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_check_delete_layout.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
    </div>
    <div class = "receptacle-init">
      <div class = "rec-init-1">
        <form accept-charset="utf-8" action = "verify_button_clicked.php?clt=<?php echo $account_num ?>" method = "post" autocomplete="off"> <!--*****-->
          <div class = "receptacle-title">
            <h2>Re-authenticate</h2>
          </div>
          <div class = "image-receptacle">
            <img src="images/profile.png" alt="profile_picture" class="profile">
          </div>


          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <input type = "text" name = "admin_username" size = "35" maxlength="35" placeholder="Enter username" required>
          </div>

          <div class = "rec-init">
            <input type = "password" name = "admin_password" size = "35" maxlength="35" placeholder="Enter password" required>
          </div>

          <div class="g-recaptcha" data-sitekey="6LfF41EUAAAAAHKiRPXympLQJn8_Uw4Kf4Sz8Jsk"></div>

          <div class = "rec-init">
            <button type = "submit">Verify</button>
          </div>
          <input type = "hidden" name = "submitted" value = "TRUE">
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
