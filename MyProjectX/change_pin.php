<?php

  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";

  $client_id = $_SESSION['userId'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/change_pwd_layout.css">
</head>
<body>
  <div class ="receptacle-background">

    <div class = "receptacle-init">
    </div>

    <div class = "receptacle-init">
      <div class = "rec-init-1">
        <form action = "change_credentials.php?ibgs=7375" class = "client_form" method = "post"> <!--*****-->
          <div class = "receptacle-title">
            <h2>Change Pin of your bank account</h2>
          </div>

          <div class=rec-init>
              <label>Enter old pin :</b></label><br>
              <input name="old-pin" size="35" type="password" required />
          </div>
          <div class= "rec-init">
              <label>Enter new pin :</label><br>
              <input name="new-pin" size="35" type="password" required />
          </div>

          <div  class= "rec-init">
              <label>Re-enter new password :</b></label><br>
              <input name="new-pin-2" size="35" type="password" required />
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
