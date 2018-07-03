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


  if(!empty($_GET['clt'])){
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($_GET['clt'])))){

      $account = escape_input($_GET['clt']);

    } else {

      $account = FALSE;

    }
  } else {

    $account = FALSE;

  }

  if($account == FALSE){
    header("location:admin_index.php?Error=true");
    exit();
  } else {
    $client_id = 0;
    $firstname = "";
    $surname = "";
    $d_o_b = "";
    $sex = "";
    $p_a_n = "";
    $email = "";
    $phone_num = "";
    $address = "";
    $account_num = 0;
    $sort_code = 0;
    $pin = "";
    $username = "";
    $password = "";

    $sql_id = "SELECT client_id, firstname, surname, d_o_b, sex, p_a_n, email, phone_num, address, sort_code, pin, username, password FROM client WHERE account_num = ?";
    if($stmt = mysqli_prepare($link, $sql_id)){
      mysqli_stmt_bind_param($stmt, "i", $param_account);
      $param_account = $account;
      $success = false;
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $client_id_r, $firstname_r, $surname_r, $d_o_b_r, $sex_r, $p_a_n_r, $email_r, $phone_num_r, $address_r, $sort_code_r, $pin_r, $username_r, $password_r);
            if(mysqli_stmt_fetch($stmt)){
              $client_id = $client_id_r;
              $firstname = $firstname_r;
              $surname = $surname_r;
              $d_o_b = $d_o_b_r;
              $sex = $sex_r;
              $p_a_n = $p_a_n_r;
              $email = $email_r;
              $phone_num = $phone_num_r;
              $address = $address_r;
              $account_num = $account;
              $sort_code = $sort_code_r;
              $pin = $pin_r;
              $username = $username_r;
              $password = $password_r;
              $success = true;
            } else {
              $log_error = "store to file";
              header("location:admin_manage_client.php?Error=true");
              exit();
            }
        } else {
          $log_error = "store to file";
          header("location:admin_manage_client.php?Error=true");
          exit();
        }

      } else{
        $log_error = "store to file";
        header("location:admin_manage_client.php?Error=true");
        exit();
      }
    } else {
      $log_error = "store to file";
      header("location:admin_manage_client.php?Error=true");
      exit();
    }

    mysqli_stmt_close($stmt);

    mysqli_close($link);
  }

?>

<?php header("Content-Type: text/html; charset=utf-8"); ?>


<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_edit_client_layout.css">
</head>
<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
      <div class = "rec-init">
        <form accept-charset="utf-8" action = "admin_account_form_update.php?clt=<?php echo htmlspecialchars($client_id, ENT_NOQUOTES, "UTF-8");?>" id = "admin_client_form" name = "admin_client_form" method = "post" autocomplete="off"> <!--*****-->
          <div class = "one">
            <div id = "pi">
              <div class = "form-title">
                <h3>Your Personal Details</h3>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Client ID : <label id = "pi_label"><?php echo htmlspecialchars($client_id, ENT_NOQUOTES, "UTF-8");?></label></label>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Firstname : </label><input id = "pi_label" name = "firstname" size = "35" maxlength="35" type = "text" value = "<?php echo htmlspecialchars(ucfirst($firstname), ENT_NOQUOTES, "UTF-8"); ?>" required>
              </div>

              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Surname : </label> <input id = "pi_label" name = "surname" size = "35"  maxlength="35" type = "text" value = "<?php echo htmlspecialchars(ucfirst($surname), ENT_NOQUOTES, "UTF-8"); ?>" required>
              </div>

              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Date Of Birth : </label> <input id = "pi_label" name = "d_o_b" size = "10" maxlength="10" type = "text" value = "<?php echo htmlspecialchars($d_o_b, ENT_NOQUOTES, "UTF-8"); ?>" required>
              </div>

              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label id = "add_label">Sex : </label>
                <input type="radio" name="sex" value="male" checked>Male <br>
                &emsp;&emsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="female">Female<br>
              </div>
            </div>
            <div id = "contact">
              <div class = "form-title">
                <h3>How We do Contact You</h3>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label id = "pi_label">Email : </label>
                <input id = "pi_label" name = "email" size = "35" maxlength="35" type = "text" value = "<?php echo htmlspecialchars($email, ENT_NOQUOTES, "UTF-8"); ?>" required>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label id = "pi_label">Contact phone : </label >
                  <input id = "pi_label" name = "phone_num" size = "11" maxlength="11" type = "text" value = "<?php echo htmlspecialchars($phone_num, ENT_NOQUOTES, "UTF-8"); ?>" required></label>
                </div>
              </div>
              <div id = "residential">
                <div class = "form-title">
                  <h3>Your Residential Address</h3>
                </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Address : <textarea id = "pi_label" rows = "2" cols = "50" size = "80" maxlength="80" name = "address" form = "admin_client_form"><?php echo htmlspecialchars($address, ENT_NOQUOTES, "UTF-8"); ?></textarea></label>
            </div>
            </div>
          </div>
          <div class = "two">
            <div id = "pid">
              <div class = "form-title">
                <h3>Your Personal Details</h3>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Primary Account Number(pan) : <label id = "pi_label"><?php echo htmlspecialchars(substr($p_a_n, 10,18), ENT_NOQUOTES, "UTF-8");?></label></label>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Account Num : </label> <input id = "pi_label" name = "account_num" size = "8" maxlength="8" type = "text" value = "<?php echo htmlspecialchars($account_num, ENT_NOQUOTES, "UTF-8"); ?>" required>
              </div>

              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Sort Code : </label> <input id = "pi_label" name = "sort_code" size = "6" maxlength="6" type = "text" value = "<?php echo htmlspecialchars($sort_code, ENT_NOQUOTES, "UTF-8"); ?>" required>
              </div>
            </div>
            <div id = "memo">
              <div class = "form-title">
                <h3>Your Memorable Information</h3>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Pin : <label id = "pi_label"><?php echo htmlspecialchars(substr($pin, 10,18), ENT_NOQUOTES, "UTF-8");?></label></label>
              </div>

              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Username : </label> <input id = "pi_label" name = "username" size = "35" maxlength="35" type = "text" value = "<?php echo htmlspecialchars($username, ENT_NOQUOTES, "UTF-8"); ?>" required>
              </div>

              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <label>Password : <label id = "pi_label"><?php echo htmlspecialchars(substr($password, 10,16), ENT_NOQUOTES, "UTF-8");?></label></label>
              </div>
            </div>
            <div id = "press">
              <div class = "form-title">
                <h3>Perform an action ???</h3>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <button  id = "myBtn" type = "submit">Update Details
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <a id = "myBtn2" href = "./admin_change_pwd.php?clt=<?php echo htmlspecialchars($client_id, ENT_NOQUOTES, "UTF-8");?>" class = "pwd-btn">Change Password</a>
              </div>

              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <a id = "myBtn3" href = "./admin_change_pin.php?clt=<?php echo htmlspecialchars($client_id, ENT_NOQUOTES, "UTF-8");?>" class = "pin-btn">Change Pin</a>
              </div>
              <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                <a id = "myBtn4" href = "./admin_change_pan.php?clt=<?php echo htmlspecialchars($client_id, ENT_NOQUOTES, "UTF-8");?>" class = "pan-btn">Change PAN</a>
              </div>
            </div>
          </div>
        </form>
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
