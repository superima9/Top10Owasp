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

  //4554 pwd , 9734 pin, 5393 pan
  $jolly = 0;

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
    $log_ids = "store to file";
    header("location:admin_manage_client.php?Error=true");
    exit();
  }

  $jolly = 0;

  if(!empty($_GET['ibgs'])){
    $case = $_GET['ibgs'];
    if($case == 4554){
      $jolly = 1;
    } elseif($case == 9734){
      $jolly = 2;
    } elseif($case == 5393){
      $jolly = 3;
    } else {
      $case = 4;
      $log_ids = "store to file";
      session_destroy();
      header("location:index.php?Error=true");
      exit();
    }
  } else {
    $case = 4;
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  if($jolly == 1){
    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['admin-pwd'])))){

      $adminpwd = escape_input($_POST['admin-pwd']);

    } else {

      $adminpwd = FALSE;
      //echo error invalid

    }

    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['new-pwd'])))){

      $newpwd = escape_input($_POST['new-pwd']);

    } else {

      $newpwd = FALSE;
      //echo error invalid

    }


    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['new-pwd-2'])))){

      $newpwd2 = escape_input($_POST['new-pwd-2']);

    } else {

      $newpwd2 = FALSE;
      //echo error invalid

    }

  } elseif ($jolly == 2) {

    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['admin-pwd'])))){

      $adminpwd = escape_input($_POST['admin-pwd']);

    } else {

      $adminpwd = FALSE;
      //echo error invalid

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

  } elseif($jolly == 3){

    if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['admin-pwd'])))){

      $adminpwd = escape_input($_POST['admin-pwd']);

    } else {

      $adminpwd = FALSE;
      //echo error invalid

    }

    if(preg_match ('%^[0-9]{16}$%', stripslashes(trim($_POST['new-pan'])))){

      $newpan = escape_input($_POST['new-pan']);

    } else {

      $newpan = FALSE;

    }

    if(preg_match ('%^[0-9]{16}$%', stripslashes(trim($_POST['new-pan-2'])))){

      $newpan2 = escape_input($_POST['new-pan-2']);

    } else {

      $newpan2 = FALSE;

    }

  } else {

    $errorr = "An error occured, please try again later.";
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  $validation_passed = false;

  if($jolly == 1){
    if($adminpwd && $newpwd && $newpwd2){

      $validation_passed = true;

    } else {

      $validation_passed = false;
      header("location:admin_manage_client.php?IncorrectToken=true");
      exit();

    }
  } elseif($jolly == 2){
    if($adminpwd && $newpin && $newpin2){

      $validation_passed = true;

    } else {

      $validation_passed = false;
      header("location:admin_manage_client.php?IncorrectToken=true");
      exit();

    }
  } elseif($jolly == 3){

    if($adminpwd && $newpan && $newpan2){

      $validation_passed = true;

    } else {

      $validation_passed = false;
      header("location:admin_manage_client.php?IncorrectToken=true");
      exit();

    }
  } else {

    $validation_passed = false;
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  $message = "-";
  $message2 = "-";
  $message3 = "-";

  if($validation_passed == true){
    switch($jolly){
      case 0:
        $message = "Error occured, Please try again later";
        break;
      case 1:

        $sql_pwd = "SELECT password FROM admin WHERE admin_id = ?";
        $sql_change_pwd = "UPDATE client SET password = ? WHERE client_id = ?";
        $error = false;
        $password_check = false;
        if($stmt = mysqli_prepare($link, $sql_pwd)){
          mysqli_stmt_bind_param($stmt, "i", $param_id);
          $param_id = $admin_id;

          if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
              mysqli_stmt_bind_result($stmt, $hashed_password);
              if(mysqli_stmt_fetch($stmt)){
                if(password_verify($adminpwd, $hashed_password)){
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
        } else {
          header("location:admin_index.php?Error=true");
          exit();
        }

        mysqli_stmt_close($stmt);

        if($error == false && $password_check == true){
          if($newpwd == $newpwd2){

              if($stmt = mysqli_prepare($link, $sql_change_pwd)){

                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_client_id);
                $param_client_id = $client_id;
                $param_password = password_hash($newpwd, PASSWORD_DEFAULT);

                $success = false;
                if(mysqli_stmt_execute($stmt)){
                  $message  = "Password changed successfully";
                  $success = true;
                } else {
                  $message  = "Error, Could not changed password, please try again later";
                }
              } else {
                header("location:admin_index.php?Error=true");
                exit();
              }
              mysqli_stmt_close($stmt);

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

        $sql_pin = "SELECT password FROM admin WHERE admin_id = ?";
        $sql_change_pin = "UPDATE client SET pin = ? WHERE client_id = ?";
        $error = false;
        $pin_check = false; // just checking admin pwd, to not create confusion I name it pin
        if($stmt = mysqli_prepare($link, $sql_pin)){
          mysqli_stmt_bind_param($stmt, "i", $param_id);  //unhash password and check if are equal
          $param_id = $admin_id;

          if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
              mysqli_stmt_bind_result($stmt, $hashed_password);
              if(mysqli_stmt_fetch($stmt)){
                if(password_verify($adminpwd, $hashed_password)){
                  $pin_check = true;
                } else {
                  $pin_check = false;
                }
              } else {
                  $error = true;
                  $log_error = "store to file";
                  header("location:manage_client.php?Error=true");
                  exit();
              }
            } else {
              $pin_check = false;
              session_destroy();
              header("location:index.php?Error=true");

            }
          } else {
            $error = true;
            $log_error = "store to file";
            header("location:manage_client.php?Error=true");
            exit();
          }
        } else {
          $log_error = "store to file";
          header("location:manage_client.php?Error=true");
          exit();
        }

        mysqli_stmt_close($stmt);

        if($error == false && $pin_check == true){
          if($newpin == $newpin2){

              if($stmt = mysqli_prepare($link, $sql_change_pin)){

                mysqli_stmt_bind_param($stmt, "si", $param_pin, $param_client_id);
                $param_client_id = $client_id;
                $param_pin = password_hash($newpin, PASSWORD_DEFAULT);

                $success = false;
                if(mysqli_stmt_execute($stmt)){
                  $message2  = "PIN changed successfully";
                  $success = true;
                } else {
                  $message2 = "Error, Could not change PIN, please try again later";
                }
              } else {
                $log_error = "store to file";
                header("location:manage_client.php?Error=true");
                exit();
              }
              mysqli_stmt_close($stmt);

          } else {
            $message2 = 'new PINs do not match';
          }
        } elseif ($password_check == false){
          $message2 = "The password entered is incorrect";
        } else {
          $message2 ="An error occured. Please try again later.";
        }

        break;


      case 3:

        $sql_pan = "SELECT password FROM admin WHERE admin_id = ?";
        $sql_change_pan = "UPDATE client SET p_a_n = ? WHERE client_id = ?";
        $error = false;
        $pan_check = false; // just checking admin pwd, to not create confusion I name it pan
        if($stmt = mysqli_prepare($link, $sql_pan)){
          mysqli_stmt_bind_param($stmt, "i", $param_id);
          $param_id = $admin_id;

          if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
              mysqli_stmt_bind_result($stmt, $hashed_password);
              if(mysqli_stmt_fetch($stmt)){
                if(password_verify($adminpwd, $hashed_password)){
                  $pan_check = true;
                } else {
                  $pan_check = false;
                }
              } else {
                  $error = true;
              }
            } else {
              $pan_check = false;
            }
          } else {
            $error = true;
          }
        } else {
          header("location:admin_index.php?Error=true");
          exit();
        }

        mysqli_stmt_close($stmt);

        if($error == false && $pan_check == true){
          if($newpan == $newpan2){

              if($stmt = mysqli_prepare($link, $sql_change_pan)){

                mysqli_stmt_bind_param($stmt, "si", $param_pan, $param_client_id);
                $param_client_id = $client_id;
                $param_pan = password_hash($newpan, PASSWORD_DEFAULT);

                $success = false;
                if(mysqli_stmt_execute($stmt)){
                  $message3  = "PAN changed successfully";
                  $success = true;
                } else {
                  $message3  = "Error, Could not changed PAN, please try again later";
                }
              } else {
                $log_error = "store to file";
                header("location:manage_client.php?Error=true");
                exit();
              }
              mysqli_stmt_close($stmt);

          } else {
            $message3 = 'new PANs do not match';
          }
        } elseif ($pan_check == false){
          $message3 = "The password entered is incorrect";
        } else {
          $message3 ="An error occured. Please try again later.";
        }

        break;

      default:
        $message = "Error occured, Please try again later";
        $log = "store to file";
        break;
    }

  } else {
    header("location:admin_manage_client.php?IncorrectToken=true");
    exit();
  }
?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_change_cred_layout.css">
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
        <?php
        if($message3 != "-"){?>
          <p id = "message"><?php  echo htmlspecialchars($message3, ENT_NOQUOTES, "UTF-8");?></p>
        <?php } ?>
      </div>

      <div class = "rec-init">
        <a href = "admin_index.php" class = "button">Home Page</a>
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
