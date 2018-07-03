<?php

  require_once "connection_to_DB.php";
  include "verify_auth.php";
  include "check_session.php";
  define('mynav', TRUE);
  define('Myheader', TRUE);
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

  //nickname
  if(preg_match ('%^[A-Za-z]{1}[A-Za-z0-9]{1,34}$%', stripslashes(trim($_POST['nickname'])))){

    $nickname = escape_input($_POST['nickname']);

  } else {

    $nickname = FALSE;

  }

  if($client_id && $surname && $firstname && $account_num && $sort_code && $nickname){
    //insert values
    $firstname_i = "";
    $surname_i = "";
    $account_num_i = 0;
    $sort_code_i = 0;
    $beneficiary_client_id_i = 0;
    $nickname_i = "";
    $message = "undefined";
    $verify = "SELECT firstname, surname, account_num, sort_code, client_id FROM client WHERE sort_code = ? AND account_num = ?";
    $ben_present = false;
    if($stmt = mysqli_prepare($link, $verify)){
      mysqli_stmt_bind_param($stmt, "ii", $param_sort_code, $param_account_num);
      $param_sort_code = $sort_code;
      $param_account_num = $account_num;

      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1){
          mysqli_stmt_bind_result($stmt, $firstname_r, $surname_r, $account_num_r, $sort_code_r, $beneficiary_client_id_r);
          if(mysqli_stmt_fetch($stmt)){
            $firstname_i = $firstname_r;
            $surname_i = $surname_r;
            $account_num_i = $account_num_r;
            $sort_code_i = $sort_code_r;
            $beneficiary_client_id_i = $beneficiary_client_id_r;
            $nickname_i = $nickname;
            $ben_present = true;
          } else {
            $ben_present = false;
            $log_error = "store to file";
            header("location:client_transfers.php?Error=true");
            exit();
          }
        } else {
          $ben_present = false;
        }

      } else {
        $log_error = "store to file";
        header("location:client_transfers.php?Error=true");
        exit();
      }
    } else {
      $log_error = "store to file";
      header("location:client_transfers.php?Error=true");
      exit();
    }
    mysqli_stmt_close($stmt);

    if($ben_present == true){
      if($client_id != $beneficiary_client_id_i){
        //NO input from user
        $sql_id = "SELECT MAX(beneficiary_id) FROM beneficiary_c".$client_id;
        $query_id = $link -> query($sql_id);
        $row = $query_id -> fetch_assoc();
        $new_client_id = $row["MAX(beneficiary_id)"] + 1;
        $adjust_id = "ALTER TABLE beneficiary_c".$client_id." AUTO_INCREMENT=".$new_client_id;
        $link->query($adjust_id);

        $insert = "INSERT INTO beneficiary_c".$client_id." VALUES ('$new_client_id', ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $insert)){
          mysqli_stmt_bind_param($stmt, "iiiss", $param_ben_id, $param_account_num, $param_sort_code, $param_fullname, $param_nickname);
          $param_ben_id = $beneficiary_client_id_i;
          $param_account_num = $account_num_i;
          $param_sort_code = $sort_code_i;
          $param_fullname = $firstname_i.' '.$surname_i;
          $param_nickname = $nickname_i;

          $success = false;
          if(mysqli_stmt_execute($stmt)){
            $message = "Recipient successfully saved";
          } else {
            $message = "Could not save beneficiary, please try again later";
            $log_error = "store to file";
          }
        } else {
          $log_error = "store to file";
          header("location:client_transfers.php?Error=true");
          exit();
        }
        mysqli_stmt_close($stmt);

        mysqli_close($link);
      } else {
        $message = "Cannot save yourself as beneficiary";
      }
    } else {
      $message = "Recipient not recongnized!";
    }
  } elseif($client_id == FALSE) {
    $log_ids = "store to a file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  } else {
    header("location:client_transfers.php?Error_token=true");
    exit();
  }


?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/check_new_ben.css">
</head>
<body>
  <div class = "receptacle-init">

    <div id = "init" class = "rec-init">
      <h3><?php echo htmlspecialchars($message, ENT_NOQUOTES, "UTF-8"); ?></h3>
      <a href = "client_index.php" class = "button">Home Page</a>
    </div>
    <div id = "init" class = "rec-init">
      <a href = "client_transfers.php" class = "button">Payment and transfers</a>
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
