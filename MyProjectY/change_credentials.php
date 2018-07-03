<?php

  require_once "connection_to_DB.php";
  include "verify_auth.php";
  include "check_session.php";
  define('Myheader', TRUE);
  define('mynav', TRUE);
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
  $client_id = $_SESSION['userId'];

  $jolly = 0;
  if(!empty($_GET['ibgs'])){
    $case = $_GET['ibgs'];
    if($case == 9475){
      $jolly = 1;
    }
    elseif($case == 7375){
      $jolly = 2;
    } else {
      $case = 3;
    }

  }else{
    $case = 3;
  }

  if($jolly == 1){
    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,24}$%', stripslashes(trim($_POST['old-pwd'])))){

      $oldpwd = escape_input($_POST['old-pwd']);

    } else {

      $oldpwd = FALSE;
      //echo error invalid

    }

    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,24}$%', stripslashes(trim($_POST['new-pwd'])))){

      $newpwd = escape_input($_POST['new-pwd']);

    } else {

      $newpwd = FALSE;
      //echo error invalid

    }


    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,24}$%', stripslashes(trim($_POST['new-pwd-2'])))){

      $newpwd2 = escape_input($_POST['new-pwd-2']);

    } else {

      $newpwd2 = FALSE;
      //echo error invalid

    }

    if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

      $client_id = escape_input($client_id);

    } else {

      $client_id = FALSE;

    }

  } elseif ($jolly == 2) {

    if(preg_match ('%^[0-9]{8,10}$%', stripslashes(trim($_POST['old-pin'])))){

      $oldpin = escape_input($_POST['old-pin']);

    } else {

      $oldpin = FALSE;

    }

    if(preg_match ('%^[0-9]{8,10}$%', stripslashes(trim($_POST['new-pin'])))){

      $newpin = escape_input($_POST['new-pin']);

    } else {

      $newpin = FALSE;

    }

    if(preg_match ('%^[0-9]{8,10}$%', stripslashes(trim($_POST['new-pin-2'])))){

      $newpin2 = escape_input($_POST['new-pin-2']);

    } else {

      $newpin2 = FALSE;

    }

    if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

      $client_id = escape_input($client_id);

    } else {

      $client_id = FALSE;

    }

  } else {

    $errorr = "An error occured, please try again later.";
    header("location:client_my_account.php?Error=true");
  }



  $validation_passed = false;

  if($jolly == 1){
    if($oldpwd && $newpwd && $newpwd2 && $client_id){

      $validation_passed = true;

    } else {

      $validation_passed = false;
      header("location:change_pwd.php?IncorrectToken=true");

    }
  } elseif($jolly == 2){
    if($oldpin && $newpin && $newpin2 && $client_id){

      $validation_passed = true;

    } else {

      $validation_passed = false;
      header("location:change_pin.php?IncorrectToken=true");

    }
  } else {

    $validation_passed = false;
    header("location:client_my_account.php?Error=true");
  }

  $message = "-";
  $message2 = "-";

  switch($jolly){
    case 0:
      $message = "Error occured, Please try again later";
      break;
    case 1:

      $sql_pwd = "SELECT password FROM client WHERE client_id = ?";
      $sql_change_pwd = "UPDATE client SET password = ? WHERE client_id = ?";
      $error = false;
      $password_check = false;
      if($stmt = mysqli_prepare($link, $sql_pwd)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);  
        $param_id = $client_id;

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $hashed_password);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($oldpwd, $hashed_password)){
                $password_check = true;
              } else {
                $password_check = false;
              }
            } else {
                $error = true;
            }
          } else {
            $password_check = false;
          }
        } else {
          $error = true;
        }
      }

      mysqli_stmt_close($stmt);

      if($error == false && $password_check == true){
        if($newpwd == $newpwd2){
          if($newpwd != $oldpwd){
            if($stmt = mysqli_prepare($link, $sql_change_pwd)){

              mysqli_stmt_bind_param($stmt, "si", $param_password, $param_client_id);
              $param_client_id = $client_id;
              $param_password = password_hash($newpwd, PASSWORD_DEFAULT);

              $success = false;
              if(mysqli_stmt_execute($stmt)){
                $message  = "Password changed successfully";
                $success = true;
              } else {
                $message  = "Error, Could not changed password, please try again later or report to us";
              }
            }
            mysqli_stmt_close($stmt);

          } else {
            $message = 'old password and new password are the same. please change';
          }
        } else {
          $message = 'new passwords do not match';
        }
      } elseif ($password_check == false){
        $message = "The password entered is incorrect";
      } else {
        $message ="An error occured. Please try again later.";
      }

      break;

    case 2:

      $sql_pin = "SELECT pin FROM client WHERE client_id = ?";
      $sql_change_pin = "UPDATE client SET pin = ? WHERE client_id = ?";
      $error = false;
      $pin_check = false;
      if($stmt = mysqli_prepare($link, $sql_pin)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);  //****************** i need to dehashe password and check if are equal
        $param_id = $client_id;

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $hashed_pin);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($oldpin, $hashed_pin)){
                $pin_check = true;
              } else {
                $pin_check = false;
              }
            } else {
                $error = true;
            }
          } else {
            $pin_check = false;
          }
        } else {
          $error = true;
        }
      }

      mysqli_stmt_close($stmt);

      if($error == false && $pin_check == true){
        if($newpin == $newpin2){
          if($newpin != $oldpin){
            if($stmt = mysqli_prepare($link, $sql_change_pin)){

              mysqli_stmt_bind_param($stmt, "si", $param_pin, $param_client_id);
              $param_pin = $newpin;
              $param_client_id = $client_id;
              $param_pin = password_hash($newpin, PASSWORD_DEFAULT);

              $success = false;
              if(mysqli_stmt_execute($stmt)){
                $message2  = "Pin changed successfully";
                $success = true;
              } else {
                $message2  = "Error, Could not changed pin, please try again later or report to us";
              }
            }
            mysqli_stmt_close($stmt);

          } else {
            $message2 = 'old pin and new pin are the same. please change';
          }
        } else {
          $message2 = 'new pins do not match';
        }
      } elseif ($pin_check == false){
        $message2 = "The pin entered is incorrect";
      } else {
        $message2 ="An error occured. Please try again later.";
      }

      break;


    case 3:
      $message = $message2 = "Error occured, Please try again later";
      break;
    default:
      $message = $message2 = "Error occured, Please try again later";
      break;
    }
?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/change_cred_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <div class = "receptacle-init">
      <div class = "rec-init">
        <?php
        if($message != "-"){?>
        <p id = "message"><?php  echo htmlspecialchars($message, ENT_NOQUOTES, "UTF-8");?></p>
      <?php } ?>
        <?php
        if($message2 != "-"){?>
          <p id = "message"><?php  echo htmlspecialchars($message2, ENT_NOQUOTES, "UTF-8");?></p>
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
