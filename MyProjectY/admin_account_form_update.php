<?php
  define('Myheader', TRUE);
  define('mynav', TRUE);
  require_once "connection_to_DB.php";
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



  if(!empty($_GET['clt'])){
    if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($_GET['clt'])))){

      $client_id = escape_input($_GET['clt']);

    } else {

      $client_id = FALSE;

    }
  } else {

    $client_id = FALSE;

  }

  //firstname
  if(preg_match ('%^[A-Za-z]{1}[A-Za-z0-9]{1,34}$%', stripslashes(trim($_POST['firstname'])))){

    $firstname = escape_input($_POST['firstname']);

  } else {

    $firstname = FALSE;

  }

  //surname
  if(preg_match ('%^[A-Za-z]{1}[A-Za-z0-9]{1,34}$%', stripslashes(trim($_POST['surname'])))){

    $surname = escape_input($_POST['surname']);

  } else {

    $surname = FALSE;

  }

  //date of birth
  if(preg_match ('%^[0-9]{4}+-[0-9]{1,2}+-[0-9]{1,2}$%', stripslashes(trim($_POST['d_o_b'])))){

    $d_o_b = escape_input($_POST['d_o_b']);

  } else {

    $d_o_b = FALSE;

  }

  //sex
  if(preg_match ('%^[a-z]{4,6}$%', stripslashes(trim($_POST['sex'])))){

    $sex = escape_input($_POST['sex']);

  } else {

    $sex = FALSE;

  }

  if(preg_match ('%^[A-Za-z0-9\.\_\-]+@[A-Za-z0-9\.\-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))){

    $email = escape_input($_POST['email']);

  } else {

    $email = FALSE;

  }

  if(preg_match ('%^[A-Za-z0-9\-\,\.\s\r\n]+$%', trim($_POST['address']))){

    $address = htmlspecialchars($_POST['address'], ENT_NOQUOTES, "UTF-8");

  } else {

    $address = FALSE;

  }

  if(preg_match ('%^([0-9]{10,11})$%', stripslashes(trim($_POST['phone_num'])))){
    $phone_num = escape_input($_POST['phone_num']);

  } else {

    $phone_num = FALSE;

  }


  //account number
  if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($_POST['account_num'])))){

    $account_num= escape_input($_POST['account_num']);

  } else {

    $account_num = FALSE;

  }

  //sortcode
  if(preg_match ('%^[0-9]{6}$%', stripslashes(trim($_POST['sort_code'])))){

    $sort_code= escape_input($_POST['sort_code']);

  } else {

    $sort_code = FALSE;

  }

  if(preg_match ('%^[A-Za-z]{1}[A-Za-z0-9]{4,34}$%', stripslashes(trim($_POST['username'])))){

    $username = escape_input($_POST['username']);

  } else {

    $username = FALSE;
    //echo error invalid

  }



  $validation_passed = false;

  if($client_id && $firstname && $surname && $d_o_b && $sex && $email && $phone_num && $address && $account_num && $sort_code && $username){
    $validation_passed = true;
  } else {
    $validation_passed = false;
  }

  if($validation_passed == true){

    $sql_upd = "UPDATE client SET firstname = ?, surname = ?, d_o_b = ?, sex = ?, email = ?, phone_num = ?, address = ?, account_num = ?, sort_code = ?, username = ? WHERE client_id = ?";

    if($stmt = mysqli_prepare($link, $sql_upd)){
      mysqli_stmt_bind_param($stmt, "ssssssssssi", $param_firstname, $param_surname, $param_dob, $param_sex, $param_email, $param_phone, $param_address, $param_account, $param_sc, $param_username, $param_client_id);
      $param_firstname = $firstname;
      $param_surname = $surname;
      $param_dob = $d_o_b;
      $param_sex = $sex;
      $param_email = $email;
      $param_phone = $phone_num;
      $param_address = $address;
      $param_account = $account_num;
      $param_sc = $sort_code;
      $param_username = $username;
      $param_client_id = $client_id;

      $success = false;
      if(mysqli_stmt_execute($stmt)){
        $message  = "Information updated successfully.";
        $success = true;
      } else {
        $message  = "Error, Could not update information, please try again later";
        $success = false;
      }
    } else {
      $log_error = "store to file";
      header("location:admin_manage_client.php?Error=true");
      exit();
    }
    mysqli_stmt_close($stmt);

  } else {
    $log_ids = "store to file";
    header("location:admin_index.php?IncorrectToken=true");
    exit();
  }

?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_account_form_update_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <p id = "info-update"><?php echo htmlspecialchars($message, ENT_NOQUOTES, "UTF-8"); ?></p>
    </div>
    <?php $link->close(); ?>
    <div class = "rec-init">
      <a href = "admin_index.php" class = "button">Home Page</a>
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
