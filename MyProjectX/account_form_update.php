<?php

  if(!isset($_SESSION)){
    session_start();
  }
  /*check if session has started*/
  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";

  $email_n = $_POST['email'];
  $address_n = $_POST['address'];
  $phone_n = $_POST['phone'];

  $sql_upd = "UPDATE client SET email = '$email_n', address = '$address_n',
  phone_num = '$phone_n' WHERE client_id =".$_SESSION['userId'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/update_profile_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <?php
        if(($link->query($sql_upd) === TRUE)){
      ?>
      <p id = "info-update"><?php echo "The details have been changed successfully"; ?></p>
      <?php
        }else{
      ?>
      <p id = "info-update"><?php echo "Error: ".$sql_upd."<br>".$link->error."<br>";?></p>
      <?php
      }
      ?>
    </div>
    <?php $link->close(); ?>

    <div class = "rec-init">
      <a href = "client_index.php" class = "button">Home Page</a>
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
