<?php

  include "header.php";
  include "navig_bar.php";

  if(isset($_GET['loginFailed'])){
    $out = "Incorrect tokens!, Please re-enter credentials.";
    echo "<script type='text/javascript'>alert('$out');</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/index_layout.css">
</head>

<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
    </div>

    <div class = "receptacle-init">
      <div class = "rec-init-1">
        <form action = "login_button_clicked.php" method = "post">
          <div class = "receptacle-title">
            <h2>Sign In</h2>
          </div>
          <div class = "image-receptacle">
            <img src="images/profile.png" alt="profile_picture" class="profile">
          </div>


          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <input type = "text" name = "client_username" placeholder="Enter username">
          </div>

          <div class = "rec-init">
            <input type = "text" name = "client_password" placeholder="Enter password">
          </div>

          <div class = "rec-init">
            <button type = "submit">Login</button>
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
