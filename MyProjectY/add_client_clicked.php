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

  //email
  if(preg_match ('%^[A-Za-z0-9\.\_\-]+@[A-Za-z0-9\.\-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))){

    $email = escape_input($_POST['email']);

  } else {

    $email = FALSE;

  }

  //Address
  if(preg_match ('%^[A-Za-z0-9\-\,\.\s\r\n]+$%', stripslashes(trim($_POST['address'])))){

    //$address = escape_input($_POST['address']);
    $address = $_POST['address'];

  } else {

    $address = FALSE;

  }

  //phone number
  if(preg_match ('%^([0-9]{10,11})$%', stripslashes(trim($_POST['phone_num'])))){
    $phone_num = escape_input($_POST['phone_num']);

  } else {

    $phone_num = FALSE;

  }

  //primary account number
  if(preg_match ('%^[0-9]{16}$%', stripslashes(trim($_POST['p_a_n'])))){

    $p_a_n = escape_input($_POST['p_a_n']);

  } else {

    $p_a_n = FALSE;

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

  //pin
  if(preg_match ('%^[0-9]{8,10}$%', stripslashes(trim($_POST['pin'])))){

    $pin = escape_input($_POST['pin']);

  } else {

    $pin = FALSE;

  }

  if(preg_match ('%^[A-Za-z]{1}[A-Za-z0-9]{4,34}$%', stripslashes(trim($_POST['username'])))){

    $username = escape_input($_POST['username']);

  } else {

    $username = FALSE;
    //echo error invalid

  }

  if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['password'])))){

    $password = escape_input($_POST['password']);

  } else {

    $password = FALSE;

  }

  $validation_passed = false;
  //$pri = "$firstname.' X '.$surname.' X '.$d_o_b.' X '.$sex.' X '.$p_a_n.' X '.$email.' X '.$phone_num.' X '.$address.' X '.$account_num.' X '.$sort_code.' X '.$pin.' X '.$username.' X '.$password";
  if($firstname && $surname && $d_o_b && $sex && $p_a_n && $email && $phone_num && $address && $account_num && $sort_code && $pin && $username && $password){
    $validation_passed = true;

  } else {
    $validation_passed = false;

    header("location:admin_add_client.php?Incorrect=true");
    exit();
  }

  //NO input from user in this, sanit
  $sql_id = "SELECT MAX(client_id) FROM client";
  $query_id = $link -> query($sql_id);
  $row = $query_id -> fetch_assoc();
  $new_client_id = $row["MAX(client_id)"] + 1;
  $adjust_id = "ALTER TABLE client AUTO_INCREMENT=".$new_client_id;
  $link->query($adjust_id);

  $sql_new_client = "INSERT INTO client VALUES (DEFAULT , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $sql_book ="CREATE TABLE bookkeeping_c".$new_client_id."(
              transaction_id INT(12) NOT NULL AUTO_INCREMENT,
              date_time DATETIME NOT NULL,
              description VARCHAR(255) NOT NULL,
              money_in FLOAT(12) NOT NULL,
              money_out FLOAT(12) NOT NULL,
              bank_balance FLOAT(12) NOT NULL,
              PRIMARY KEY(transaction_id)
             )";
             
  $sql_ben ="CREATE TABLE beneficiary_c".$new_client_id."(
            beneficiary_id INT(12) NOT NULL AUTO_INCREMENT,
            beneficiary_client_id INT(12) NOT NULL UNIQUE,
            account_num INT(8) NOT NULL UNIQUE,
            sort_code INT(6) NOT NULL UNIQUE,
            beneficiary_client_full_name VARCHAR(70) NOT NULL,
            beneficiary_saved_us VARCHAR(35) NOT NULL,
            PRIMARY KEY(beneficiary_id)
        )";


$sql_start = "INSERT INTO bookkeeping_c".$new_client_id." VALUES(
            DEFAULT,
            NOW(),
            'Opening Balance',
            '1000',
            '0',
            '1000'
        )";

?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/add_client_clicked_layout.css">
</head>
<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
      <div class = "rec-init-0">
      <?php
      if($validation_passed == true){

      } else {
        header("location:admin_add_client.php?Incorrect=true");
        exit();
      }
      ?>
      <?php
        $username_taken = false;
        $error = false;
        $sql = "SELECT client_id FROM client WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $param_username);
          $param_username = $username;

          $error = false;
          $username_taken = false;
          if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
              $username_taken = true;
            } else {
              $username_taken = false;
            }
          } else {
            $error = true;
            $log_error = "store to file";
            header("location:admin_add_client.php?Error=true");
            exit();
          }
        } else {
          $log_error = "store to file";
          header("location:admin_add_client.php?Error=true");
          exit();
        }

        mysqli_stmt_close($stmt);

        if($error == false && $username_taken == false){
          if($stmt = mysqli_prepare($link, $sql_new_client)){
            mysqli_stmt_bind_param($stmt, "sssssssssssss", $param_firstname, $param_surname, $param_dob, $param_sex, $param_pan, $param_email, $param_phone, $param_address, $param_account, $param_sc, $param_pin, $param_username, $param_password);
            $param_firstname = $firstname;
            $param_surname = $surname;
            $param_dob = $d_o_b;
            $param_sex = $sex;
            $param_pan = password_hash($p_a_n, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_phone = $phone_num;
            $param_address = $address;
            $param_account = $account_num;
            $param_sc = $sort_code;
            $param_pin = password_hash($pin, PASSWORD_DEFAULT);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);


            $success = false;
            if(mysqli_stmt_execute($stmt)){ ?>
            <p><?php echo htmlspecialchars("The new customer have been added to the table", ENT_NOQUOTES, "UTF-8");?><br></p>
            <?php
              $success = true;
            } else {
              $success = false; ?>
            <p><?php echo htmlspecialchars("Could not add a new customer to the table", ENT_NOQUOTES, "UTF-8"); ?><br></p>
    <?php   }
          } else {
            $log_error = "store to file";
            header("location:admin_add_client.php?Error=true");
            exit();
          }
          mysqli_stmt_close($stmt);

          if($success == true){
            if(($link-> query($sql_book) === TRUE)){ ?>
              <p><?php echo htmlspecialchars("The customer bookeeping's table has been created", ENT_NOQUOTES, "UTF-8");?><br></p>
       <?php  if(($link-> query($sql_start) === TRUE)){ ?>
                 <p><?php echo htmlspecialchars("The customer bookeeping has been initialized", ENT_NOQUOTES, "UTF-8"); ?><br></p>
        <?php } else { ?>
                <?php $message = "Error: <br>".$link->error."<br>"; ?>
                <p><?php echo htmlspecialchars("The customer bookeeping was not able to open the balance", ENT_NOQUOTES, "UTF-8");?><br></p>
        <?php } ?>
      <?php } else { ?>
              <?php $message1 = "Error: <br>".$link->error."<br>"; ?>
              <p><?php echo htmlspecialchars("The customer bookeeping table could not be created", ENT_NOQUOTES, "UTF-8"); ?><br></p>
      <?php } ?>
      <?php if(($link-> query($sql_ben) === TRUE)){ ?>
              <p><?php echo htmlspecialchars("The customer beneficiary's table has been created", ENT_NOQUOTES, "UTF-8"); ?><br></p>
      <?php } else { ?>
              <?php $message2 = "Error: <br>".$link->error."<br>"; ?>
              <p><?php echo htmlspecialchars("The customer beneficiary table could not be created".$message2, ENT_NOQUOTES, "UTF-8"); ?><br></p>
      <?php }
          } else { ?>
            <p><?php echo htmlspecialchars("Could not add any of those tables, because an error occured.", ENT_NOQUOTES, "UTF-8");?><br></p>
    <?    }

        } elseif($username_taken = true){ ?>
            <p><?php echo htmlspecialchars("The username has already been taken", ENT_NOQUOTES, "UTF-8"); ?><br></p>
  <?php } else { ?>
          <p><?php echo htmlspecialchars("An error occured. Please try again later.", ENT_NOQUOTES, "UTF-8"); ?><br></p>
  <?php }
      mysqli_close($link);

  ?>
      </div>
      <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
        <a href = "./admin_add_client.php" class = "button">Back</a>  <!-- you want to go back to the page where they have sthe list of recip tho -->
      </div>
      <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
        <a href = "./admin_index.php" class = "button">Home page</a>  <!-- you want to go back to the page where they have sthe list of recip tho -->
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
