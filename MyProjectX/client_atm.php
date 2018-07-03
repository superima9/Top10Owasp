<?php
  include "header.php";
  include "client_navig_bar.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/client_atm_layout.css">
</head>
<body>
  <div class = "receptacle-background">

      <form class = "atm_form" action = "check_atm_form.php" method = "post">
        <div class = "title">
          <h3>Welcome to the Atm</h3>
        </div>

        <div class = "receptacle-init">
          <div class = "rec-init">
            <label>Please enter import: &pound</label>
            <input name = "import" size = "25" placeholder="00.00"type = "text" required/>
          </div>
        </div>

        <div class = "receptacle-init">
          <div class = "rec-init">
            <label>Please enter your 4 Pin Digit: </label>
            <input name = "pin" size = "4" type = "text" required/>
          </div>
        </div>

        <div class = "receptacle-init">
          <div class = "rec-init">
            <button class = "button" type = "submit">Tranfer</button>
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
  
