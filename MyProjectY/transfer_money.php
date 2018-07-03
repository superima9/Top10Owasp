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

  if($client_id == FALSE){
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }


  $sql1 = "SELECT bank_balance FROM bookkeeping_c".$client_id." ORDER BY transaction_id DESC LIMIT 1";

  $receiver = "ciao";
  $query_1 = $link -> query($sql1);
  $row1 = $query_1 -> fetch_assoc();

  if($query_1 -> num_rows > 0){
    $bank_balance = $row1['bank_balance'];
  } else {
    $log_error = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  if(!empty($_GET['rcv'])){
    include_once "encrypt.php";
    $receiver = encrypt('decrypt', $_GET['rcv']);
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($receiver)))){

      $receiver = escape_input($receiver);

    } else {

      $receiver = FALSE;

    }
  } else {

    $receiver = FALSE;

  }

  if($receiver == FALSE){
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  } else {
    $sql0 = "SELECT account_num, client_id, sort_code, firstname, surname FROM client WHERE account_num = ?";
    $account_num_r = "";
    $client_id_r = "";
    $sort_code_r = "";
    $firstname_r = "";
    $surname_r = "";
    if($stmt = mysqli_prepare($link, $sql0)){
      mysqli_stmt_bind_param($stmt, "s", $param_account);
      $param_account = $receiver;

      $success = false;
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
          mysqli_stmt_bind_result($stmt, $account_num, $client_id, $sort_code, $firstname, $surname);
          if(mysqli_stmt_fetch($stmt)){
            $account_num_r = $account_num;
            $client_id_r = $client_id;
            $sort_code_r = $sort_code;
            $firstname_r = $firstname;
            $surname_r = $surname;
          } else {
            $log_error = "store to file";
            header("location:client_transfers.php?Error=true");
            exit();
          }
        } else {
          $log_client = "store to file";
          header("location:client_transfers.php?Error_client=true");
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

    mysqli_close($link);
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/client_transfers_clicked.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
  <div class = "receptacle-background">
    <form accept-charset="utf-8" class = "transfer_money" action = "check_transfer.php?clt=<?php echo htmlspecialchars($client_id_r, ENT_NOQUOTES, "UTF-8"); ?>" method = "post" autocomplete="off">
      <div id = "title" class = "receptacle-init">
        <div id = 'title-init'class = "rec-init">
        <h4 id = "form_title">Payments and Transfers</h4>
        </div>
      </div>

      <div class = "receptacle-init">
        <div class = "rec-init">
          <h3>Available Balance: <?php echo htmlspecialchars($bank_balance, ENT_NOQUOTES, "UTF-8"); ?></h3>
        </div>
      </div>

      <div class = "receptacle-init">
        <h3 id = "client.this-info">Sending money to:</h3>
        <div class = "rec-init">
          <p id = "client.this-info">Recipient:<?php echo htmlspecialchars($firstname_r." ".$surname_r, ENT_NOQUOTES, "UTF-8"); ?></p>
          <p id = "client.this-info">AN:<?php echo htmlspecialchars($account_num_r, ENT_NOQUOTES, "UTF-8"); ?></p>
          <p id = "client.this-info">SC:<?php echo htmlspecialchars($sort_code_r, ENT_NOQUOTES, "UTF-8"); ?></p>
        </div>
      </div>

      <div id = "pay-back" class = "receptacle-init">
        <div class = "pay-back"> <!--input type require that before submitting,fill out box-->
          <label id = "pi_label">Enter import: £ </label>
          <input name = "import" size = "10" maxlength="10" type = "text" placeholder = "00.00" required>

          <label id = "pi_label">Enter Password: </label>
          <input name = "password" size = "35" maxlength="35" type = "password" placeholder = "Enter password" required>

          <div class="g-recaptcha" data-sitekey="6LfF41EUAAAAAHKiRPXympLQJn8_Uw4Kf4Sz8Jsk">
          </div>

          <input type = "hidden" name = "XSRF" value = "TRUE">
          <div id = "pay"class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <button id = "myBtn" type = "submit">Pay Recipient</button>
          </div>
          <div id = "pay" class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <a id = "myBtn1" href = "./client_index.php" class = "back-btn">Cancel</a>  <!-- you want to go back to the page where they have sthe list of recip tho -->
          </div>
        </div>
      </div>
    </form>
  </div>
  <footer>
    <div class ="Copyright">
      <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
      <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
    </div>
  </footer>
</body>
</html>
