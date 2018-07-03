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

  if(preg_match ('%^[0-9]+(?:\.[0-9]{1,2})?$%', $_POST['import'])){

    $import = escape_input($_POST['import']);


  } else {

    $import = FALSE;

  }

  if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['password'])))){

    $password = escape_input($_POST['password']);

  } else {

    $password = FALSE;
    //echo error invalid

  }

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

    $client_id = escape_input($client_id);

  } else {

    $client_id = FALSE;

  }

  if(isset($_POST['XSRF'])){
    $recaptcha = false;
    $secret_Key = "6LfF41EUAAAAALAzO0VfrrBZ-VB3OntWDGhUJvzs";
    $response_Key = $_POST["g-recaptcha-response"];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_Key&response=$response_Key&remoteip=$userIP";

    $response = file_get_contents($url);
    $response = json_decode($response);

    if($response->success){
      $recaptcha = true;
    } else {
      $recaptcha = false;
    }
  } else {
    $recaptcha = false;
  }

  if($import && $password && $client_id && $recaptcha){

    if(!empty($_GET['clt'])){
      if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($_GET['clt'])))){

        $ben_client_id = escape_input($_GET['clt']);

      } else {

        $ben_client_id = FALSE;

      }

    } else {

      $ben_client_id = FALSE;

    }

    if($ben_client_id == FALSE) {
      $log_ids = "store to file";
      session_destroy();
      header("location:index.php?Error=true");
      exit();

    } else {

      $success = false;
      $sql = "SELECT password, surname, firstname, account_num, sort_code FROM client WHERE client_id = ?";
      $user_surname = "";
      $user_firstname = "";
      $user_account_num = "";
      $user_sort_code = "";
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_client_id);
        $param_client_id = $client_id;

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $hashed_password, $surname, $firstname, $account_num, $sort_code);
            if(mysqli_stmt_fetch($stmt)){
              $user_surname = $surname;
              $user_firstname = $firstname;
              $user_account_num = $account_num;
              $user_sort_code = $sort_code;
              if(password_verify($password, $hashed_password)){
                $success = true;
              } else {
                $success = false;
              }
            } else {
              $success = false;
              $log_error = "store to file";
              header("location:client_transfers.php?Error=true");
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
          header("location:client_transfers.php?Error=true");
          exit();
        }
      } else {
        $log_error = "store to file";
        header("location:client_transfers.php?Error=true");
        exit();
      }
      mysqli_stmt_close($stmt);

      //beneficiary_c
      $success2 = false;
      $sqla = "SELECT surname, firstname, account_num, sort_code FROM client WHERE client_id = ?";
      $ben_surname = "";
      $ben_firstname = "";
      $ben_account_num = "";
      $ben_sort_code = "";
      if($stmt = mysqli_prepare($link, $sqla)){
        mysqli_stmt_bind_param($stmt, "i", $param_client_id);
        $param_client_id = $ben_client_id;

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $surname, $firstname, $account_num, $sort_code);
            if(mysqli_stmt_fetch($stmt)){
              $ben_surname = $surname;
              $ben_firstname = $firstname;
              $ben_account_num = $account_num;
              $ben_sort_code = $sort_code;
              $success2 = true;
            } else {
              $success2 = false;
              $log_error = "store to file";
              header("location:client_transfers.php?Error=true");
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
          header("location:client_transfers.php?Error=true");
          exit();
        }
      } else {
        $log_error = "store to file";
        header("location:client_transfers.php?Error=true");
        exit();
      }
      mysqli_stmt_close($stmt);
      //ben finished
      //chech if password correct and if beneficiary is still on the db
      if($success == true && $success2 = true){
        if($user_account_num != $ben_account_num){
          $sql1 = "SELECT * FROM bookkeeping_c".$client_id." ORDER BY transaction_id DESC LIMIT 1";
          $query_sender_balance = $link -> query($sql1);
          $row1 = mysqli_fetch_assoc($query_sender_balance);
          ini_set("precision", 2);
          $new_sender_balance = $row1['bank_balance'] - $import;
          #Check if he has sufficient funds
          if($new_sender_balance >= 0){
            $sqlb = "SELECT bank_balance FROM bookkeeping_c".$ben_client_id." ORDER BY transaction_id DESC LIMIT 1";
            $query_ben_pi = $link -> query($sqlb);
            $rowb = mysqli_fetch_assoc($query_ben_pi);
            $new_ben_balance = $rowb['bank_balance'] + $import;

            $description_B = "P2P - Received from  ".$user_surname." ".$user_firstname." -> AN: ".$user_account_num." SC:".$user_sort_code;
            $description_S = "P2P - Transferred to ".$ben_surname." ".$ben_firstname." -> AN: ".$ben_account_num." SC:".$ben_sort_code;

            #Update import in the database table sender
            $sql_clt_update = "INSERT INTO bookkeeping_c".$client_id." VALUES(DEFAULT, NOW(), ?, '0', ?, ?)";
            $inserted = false;
            if($stmt = mysqli_prepare($link, $sql_clt_update)){
              mysqli_stmt_bind_param($stmt, "sdd", $param_desc, $param_import, $param_new_balance);
              $param_desc = $description_S;
              $param_import = $import;
              $param_new_balance = $new_sender_balance;

              if(mysqli_stmt_execute($stmt)){
                $inserted = true;
              } else {
                $inserted = false;
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
            //finish insertion row sender table bookkeeping

            #Update import in the database table receiver
            $sql_ben_update = "INSERT INTO bookkeeping_c".$ben_client_id." VALUES(DEFAULT, NOW(), ?, ?, '0', ?)";
            $inserted2 = false;
            if($stmt = mysqli_prepare($link, $sql_ben_update)){
              mysqli_stmt_bind_param($stmt, "sdd", $param_desc, $param_import, $param_new_balance);
              $param_desc = $description_B;
              $param_import = $import;
              $param_new_balance = $new_ben_balance;

              if(mysqli_stmt_execute($stmt)){
                $inserted2 = true;
              } else {
                $inserted2 = false;
                $log_error_money = "store to file";
                $log_error = "store to file";
                header("location:client_transfers.php?Error=true");
                exit();
              }
            } else {
              $log_error_money = "store to file";
              header("location:client_transfers.php?Error=true");
              exit();
            }
            mysqli_stmt_close($stmt);

            mysqli_close($link);
            //check if both tables have been updated
            if($inserted == true && $inserted2 == true){
              $message = "Transaction completed successfully";

            } elseif($inserted == true && $inserte2 == false){
              $message = "An error occured during the transaction, please visit your nearest branch or give us a call";
              $log_error_money = "store in a file";
            } else {
              $message = "An error occured during the transaction, please visit your nearest branch or give us a call";
              $log_error_money = "store in a file";
            }

          }else{
            $message = "Error: Insufficient funds";
          }
        }else {
          $message = "You cannot tranfer money to yourself.";
        }
      } elseif($success == false && $success2 == true){
        $message = "Error: You have not entered the correct password";
      } else {
        $message = "Error: Could not send amount to Recipient because it has been deleted or disactivated";
      }
    }

  } elseif($recaptcha === false){
    //recaptcha failed
    session_destroy();
    header("location:index.php?IORobot=true");
    $log_ids = "store to file";
    exit();

  }  elseif($import == FALSE && $client_id != FALSE){

    header("location:client_transfers.php?Error_import=true");
    exit();

  } elseif($client_id == FALSE){
    session_destroy();
    header("location:index.php?Error=true");
    $log_ids = "store in a file";
  } else {
    header("location:client_transfers.php?Error=true");
    session_destroy();
    header("location:index.php?Error=true");
    $log_ids = "store in a file";
  }


?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/check_transfer_clk_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <p><?php echo htmlspecialchars($message, ENT_NOQUOTES, "UTF-8");?></p>
    </div>

    <div class = "rec-init">
      <a href = "client_index.php" class = "button">Home Page</a>
      <a href = "client_transfers.php" class = "button">Payment and transfers</a>
    </div>
    <footer>
      <div class ="Copyright">
        <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
        <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
      </div>
    </footer>
</body>
</html>
