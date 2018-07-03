<?php

  require_once "connection_to_DB.php";
  include "verify_auth.php";
  include "check_session.php";


  $_SESSION['LAST_ACTIVITY'] = time();
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

  if(isset($_GET['Error'])){
    $err = "Something went wrong. Please try again later.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['IncorrectToken'])){
    $err = "Please enter valid tokens.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }


  $client_id = $_SESSION['userId'];

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

    $client_id = escape_input($client_id);

  } else {

    $client_id = FALSE;

  }

  if($client_id == FALSE){
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  $client_details = "SELECT * FROM client WHERE client_id = ".$client_id;
  $client_last_trans = "SELECT * FROM bookkeeping_c".$client_id." WHERE transaction_id=
  (SELECT MAX(transaction_id) FROM bookkeeping_c".$client_id.")";

  $client_info = $link -> query($client_details);
  $client_data_trans = $link -> query($client_last_trans);


  #get PI
  if($client_info -> num_rows == 1){
    while($row = mysqli_fetch_assoc($client_info)){
      $firstname = $row['firstname'];
      $surname = $row['surname'];
      $d_o_b = $row['d_o_b'];
      $sex = $row['sex'];
      $email = $row['email'];
      $phone_num = $row['phone_num'];
      $address = $row['address'];
      $account_num = $row['account_num'];
      $sort_code = $row['sort_code'];
      $username = $row['username'];
    }
  } else {
    $log = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }
  # get bank balance
  if($client_data_trans -> num_rows > 0){
    while($row = mysqli_fetch_assoc($client_data_trans)){
      $bank_balance = $row['bank_balance'];
    }
  } else {
    $log_error = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/profile_layout.css">
</head>
<body>
<div class ="receptacle-background">
  <div class = "receptacle-init">
    <form accept-charset="utf-8" action = "account_form_update.php" id = "client_form" name = "client_form" method = "post" autocomplete="off"> <!--*****-->
      <div class = "one">
        <div id = "pi">
          <div class = "form-title">
            <h3>Your Personal Details</h3>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Firstname : <label id = "pi_label"><?php echo htmlspecialchars(ucfirst($firstname), ENT_NOQUOTES, "UTF-8"); ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Surname : <label id = "pi_label"><?php echo htmlspecialchars(ucfirst($surname), ENT_NOQUOTES, "UTF-8"); ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Date Of Birth : <label id = "pi_label"><?php echo htmlspecialchars(ucfirst($d_o_b), ENT_NOQUOTES, "UTF-8"); ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Sex : <label id = "pi_label"><?php echo htmlspecialchars(ucfirst($sex), ENT_NOQUOTES, "UTF-8"); ?></label></label>
          </div>
        </div>
        <div id="contact">
          <div class = "form-title">
            <h3>How We do Contact You</h3>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Email : </label><input id = "pi_label" name = "email" size = "35" type = "text" value = "<?php echo htmlspecialchars($email, ENT_NOQUOTES, "UTF-8"); ?>" required>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label> Contact phone : </label ><input id = "pi_label" name = "phone" size = "15" type = "text" value = "<?php echo htmlspecialchars($phone_num, ENT_NOQUOTES, "UTF-8"); ?>" required>
          </div>
        </div>

        <div id= "residential">
          <div class = "form-title">
            <h3>Your Residential Address</h3>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label id = "address">Address :<textarea id = "pi_label" rows = "2" cols = "50" name = "address" form = "client_form"><?php echo htmlspecialchars($address, ENT_NOQUOTES, "UTF-8"); ?></textarea></label>
          </div>
        </div>
      </div>
      <div class = "two">
        <div id = "pid">
          <div class = "form-title">
            <h3>Your Personal Details</h3>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Account Num : <label id = "pi_label"><?php echo htmlspecialchars($account_num, ENT_NOQUOTES, "UTF-8"); ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Sort Code : <label id = "pi_label"><?php echo htmlspecialchars($sort_code, ENT_NOQUOTES, "UTF-8"); ?></label></label>
          </div>
        </div>

        <div id = "memo">
          <div class = "form-title">
            <h3>Your Memorable Information</h3>
          </div>


          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Username : <label id = "pi_label"><?php echo htmlspecialchars($username, ENT_NOQUOTES, "UTF-8"); ?></label></label>
          </div>


        </div>
        <div id = "press">
          <div class = "form-title">
            <h3>Perform an action ???</h3>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <button id = "myBtn" type = "submit">Update Details
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <a id = "myBtn2" href = "./change_pwd.php" class = "pwd-btn">Change Password</a>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <a id = "myBtn3" href = "./change_pin.php" class = "pin-btn">Change Pin</a>
          </div>
        </div>
        </div>
      </form>
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
