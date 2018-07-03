<?php

  if(!isset($_SESSION)){
    session_start();
  }
  /*check if session has started*/
  include "connection_to_DB.php";
  include "header.php";
  include "admin_navig_bar.php";


  if(!empty($_GET['clt'])){
    $client_id = $_GET['clt'];
  }

  $firstname = $_POST['firstname'];
  $surname = $_POST['surname'];
  $d_o_b = $_POST['d_o_b'];
  $sex = $_POST['sex'];
  $p_a_n = $_POST['p_a_n'];
  $email = $_POST['email'];
  $phone_num = $_POST['phone_num'];
  $address = $_POST['address'];
  $account_num = $_POST['account_num'];
  $sort_code = $_POST['sort_code'];
  $pin = $_POST['pin'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql_upd = "UPDATE client SET firstname = '$firstname', surname = '$surname', d_o_b = '$d_o_b', sex = '$sex', email = '$email', phone_num = '$phone_num', address = '$address', account_num = '$account_num', sort_code = '$sort_code', pin = '$pin', username = '$username', password = '$password' WHERE client_id =".$client_id;
?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_account_form_update_layout.css">

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
      <a href = "admin_index.php" class = "button">Home Page</a>
    </div>
  </div>
  <!--<footer>
    <div class ="Copyright">
	   	<p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
	    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
	  </div>
  </footer>-->
</body>
</html>
