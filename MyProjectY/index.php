<?php
  define('Myheader', TRUE);
  include "header.php";
  define('mynav', TRUE);
  include "navig_bar.php";

  if(isset($_GET['loginIncorrect'])){
    $err = "Please enter a valid username and password.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['loginError'])){
    $err = "Something went wrong. Please try again later.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['loginFailed'])){
    $out = "Incorrect tokens!, Please re-enter credentials.";
    echo "<script type='text/javascript'>alert('$out');</script>";
  }

  if(isset($_GET['IORobot'])){
    $out = "Recaptcha authentication, failed, try again.";
    echo "<script type='text/javascript'>alert('$out');</script>";
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
  <link rel = "stylesheet" href = "./css/index_layout.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
      <div class = "rec-init-1">
        <!--<?php echo exec('whoami');?> -->
        <form accept-charset="utf-8" action = "login_button_clicked.php" method = "post" autocomplete="off">

          <div class = "receptacle-title">
            <h2>Sign In</h2>
          </div>
          <div class = "image-receptacle">
            <img src="images/profile.png" alt="profile_picture" class="profile">
          </div>

          <div class = "rec-init">
            <input type = "text" name = "client_username" size = "35" maxlength="35" placeholder="Enter username" required>
          </div>

          <div class = "rec-init">
            <input type = "password" name = "client_password" size = "35" maxlength="35" placeholder="Enter password" required>
          </div>

          <div class="g-recaptcha" data-sitekey="6LfF41EUAAAAAHKiRPXympLQJn8_Uw4Kf4Sz8Jsk">
          </div>

          <div class = "rec-init">
            <button type = "submit">Login</button>
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
