<?php
  define('Myheader', TRUE);
  define('mynav', TRUE);
  require_once("connection_to_DB.php");
  include "verify_auth.php";
  include "check_session.php";
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

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

    $client_id = escape_input($client_id);

  } else {

    $client_id = FALSE;

  }

  if(preg_match ('%^[A-Za-z0-9\.\_\-]+@[A-Za-z0-9\.\-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))){

    $email_n = escape_input($_POST['email']);

  } else {

    $email_n = FALSE;

  }


  if(preg_match ('%^([0-9]{10,11})$%', stripslashes(trim($_POST['phone'])))){

    $phone_n = escape_input($_POST['phone']);

  } else {

    $phone_n = FALSE;

  }


  if(preg_match ('%^[A-Za-z0-9\-\,\.\s\r\n]+$%', trim($_POST['address']))){

    $address_n = htmlspecialchars($_POST['address'], ENT_NOQUOTES, "UTF-8");

  } else {

    $address_n = FALSE;

  }

  $validation_passed = false;

  if($client_id && $email_n && $address_n && $phone_n){
    $validation_passed = true;
  } else {
    $validation_passed = false;
  }

  $sql_upd = "UPDATE client SET email = ?, address = ?, phone_num = ? WHERE client_id =?" ;

?>

<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/update_profile_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <?php
    $message = "-";
    if($validation_passed == true){
      if($stmt = mysqli_prepare($link, $sql_upd)){

        mysqli_stmt_bind_param($stmt, "sssi", $param_email, $param_address, $param_phone, $param_client_id);
        $param_email = $email_n;
        $param_client_id = $client_id;
        $param_phone = $phone_n;
        $param_address = $address_n;

        $success = false;
        if(mysqli_stmt_execute($stmt)){
          $message  = "Information updated successfully.";
          $success = true;
        } else {
          $success = false;
          $message  = "Error, Could not update information, please try again later or report to us";
        }
      } else {
        $log_error = "store to file";
        header("location:client_my_account.php?Error=true");
        exit();
      }
      mysqli_stmt_close($stmt);

      mysqli_close($link);

    } else {
      $message = "Please enter valid inputs.";
      header("location:client_my_account.php?IncorrectToken=true");
      exit();
    }
      ?>
      <?php
      if($message != "-"){?>
      <p id = "message"><?php  echo htmlspecialchars($message, ENT_NOQUOTES, "UTF-8");?></p>
<?php } else { ?>
      <p>Something went wrong, please try again later, or report to us.</p>
<?php } ?>
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
