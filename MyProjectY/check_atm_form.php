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

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

    $client_id = escape_input($client_id);

  } else {

    $client_id = FALSE;

  }

  if(preg_match ('%^[0-9]+(?:\.[0-9]{1,2})?$%', $_POST['import'])){  // check overall size import

    $import = escape_input($_POST['import']);


  } else {

    $import = FALSE;

  }

  if(preg_match ('%^[0-9]{8,10}$%', stripslashes(trim($_POST['pin'])))){

    $pin = escape_input($_POST['pin']);

  } else {

    $pin = FALSE;

  }

  $validation_passed = false;

  if($import && $pin && $client_id){
    $validation_passed = true;
  } else {
    $validation_passed = false;
  }

  $message = "ciao";

  if($validation_passed == true){
    $sql = "SELECT pin, firstname, surname, account_num, sort_code FROM client WHERE client_id = ?";
    $pin_correct = false;
    $firstname = "";
    $surname = "";
    $account_num = "";
    $sort_code = "";
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_client_id);
        $param_client_id = $client_id;

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $pin_r, $firstname_r, $surname_r, $account_num_r, $sort_code_r);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($pin, $pin_r)){
                $firstname = $firstname_r;
                $surname = $surname_r;
                $account_num = $account_num_r;
                $sort_code = $sort_code_r;
                $pin_correct = true;
              } else {
                $pin_correct = false;
              }
            } else {
              $pin_correct = false;
              $log_error = "store to file";
              header("location:client_atm.php?Error=true");
              exit();
            }
          } else {
            $log_ids = "store to file";
            session_destroy();
            header("location:index.php?Error=true");
            exit();
          }
        } else {
          $log_error = "store to file";
          header("location:client_atm.php?Error=true");
          exit();
        }
      } else {
        $log_error = "store to file";
        header("location:client_atm.php?Error=true");
        exit();
      }
      mysqli_stmt_close($stmt);

      if($pin_correct == true){
        $sql1 = "SELECT * FROM bookkeeping_c".$client_id." ORDER BY transaction_id DESC LIMIT 1";
        $query_sender_balance = $link -> query($sql1);
        $row1 = mysqli_fetch_assoc($query_sender_balance);
        $new_sender_balance = $row1['bank_balance'] - $import;
        #Check if he has sufficient funds
        if($new_sender_balance >= 0){
          $description_self = "P2P - Cash withdrawl ".$firstname." ".$surname." -> AN: ".$account_num." SC: ".$sort_code;
          $sql_self_update = "INSERT INTO bookkeeping_c".$client_id." VALUES(DEFAULT, NOW(), ?, '0', ?, ?)";

          
          $inserted = false;
          if($stmt = mysqli_prepare($link, $sql_self_update)){
            mysqli_stmt_bind_param($stmt, "sdd", $param_desc, $param_import, $param_new_sender_balance);
            $param_desc = $description_self;
            $param_import = $import;
            $param_new_sender_balance = $new_sender_balance;

            if(mysqli_stmt_execute($stmt)){
              $inserted = true;
            } else {
              $inserted = false;
            }
          } else{
            $log_error = "store to file";
            header("location:client_atm.php?Error=true");
            exit();
          }
          mysqli_stmt_close($stmt);

          mysqli_close($link);

          if($inserted == true){
            $message = "Withdrawl completed successfully.";
          } else {
            $message = "An error occured during the transaction, please visit your nearest branch or give us a call";
          }

        } else {
          $message = "Error: Insufficient funds";
        }
      } else {
        $message = "The pin you have entered is not correct.";
      }
  } elseif($client_id == false) {
    $log_ids = "store to a file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  } elseif($import == false){
    header("location:client_atm.php?Error_import=true");
    exit();
  } else {
    $log_ids = "store to file";
    header("location:client_atm.php?Error=true");
    exit();
  }

?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/check_atm_form_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <p><?php echo htmlspecialchars($message, ENT_NOQUOTES, "UTF-8");?></p>
    <div class = "rec-init">
      <a href = "client_index.php" class = "button">Home Page</a>
      <a href = "client_atm.php" class = "button">ATM</a>
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
