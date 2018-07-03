<?php

  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";
  $client_id = $_SESSION['userId'];
  $jolly = 0;
  if(!empty($_GET['ibgs'])){
    $case = $_GET['ibgs'];
    if($case == 9475){
      $jolly = 1;
    }
    if($case == 7375){
      $jolly = 2;
    }
    }else{
    $case = 3;
    }

  $message = "-";
  $message2 = "-";
  switch($jolly){
    case 0:
      break;
    case 1:
      $oldpwd = $_POST["old-pwd"];
      $newpwd = $_POST["new-pwd"];
      $newpwd2 = $_POST["new-pwd-2"];

      $sql_pwd = "SELECT * FROM client WHERE client_id = '".$client_id."' AND password = '".$oldpwd."'";
      $query_pwd = $link->query($sql_pwd);
      $row_p = $query_pwd->fetch_assoc();
      if(($query_pwd->num_rows)>0){
        if($newpwd == $newpwd2){
          if($newpwd == $oldpwd){
            $message = "The new password and the old passeord do match";
          }else{
            $sql1 = "UPDATE client SET password = '$newpwd' WHERE client_id =".$client_id;
            if(($link->query($sql1) === TRUE)){
              $message = "Succesfull change of password";
            }
          }
        }else{
          $message = 'new passwords do not match';
        }
      }else{
        $message = 'old password is incorrect';
      }
      break;
    case 2:
        $oldpin = $_POST["old-pin"];
        $newpin = $_POST["new-pin"];
        $newpin2 = $_POST["new-pin-2"];
        $sql_pin = "SELECT * FROM client WHERE client_id = '".$client_id."' AND pin = '".$oldpin."'";
        $query_pin = $link->query($sql_pin);
        $row_n = $query_pin->fetch_assoc();
        if(($query_pin->num_rows)>0){
          if($newpin == $newpin2){
            if($newpin == $oldpin){
              $message2 = "The new password and the old passeord do match";
            }
            else{
              $sql2 = "UPDATE client SET pin = '$newpin' WHERE client_id =".$client_id;
              if(($link->query($sql2) === TRUE)){
                $message2 = "Succesfull change of pin";
              }
            }
          }else{
            $message = 'new Pins do not match';
          }
        }else{
          $message = 'old password is incorrect';
        }
        break;

      default:
        $message = "Error occured!!!";
        break;
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/change_cred_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <div class = "receptacle-init">
      <div class = "rec-init">
        <?php
        if($message != "-"){?>
        <p id = "message"><?php  echo $message;?></p>
        <?php } ?>
        <?php
        if($message2 != "-"){?>
          <p id = "message"><?php  echo $message2;?></p>
        <?php } ?>

      </div>

      <div class = "rec-init">
        <a href = "client_index.php" class = "button">Home Page</a>
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
