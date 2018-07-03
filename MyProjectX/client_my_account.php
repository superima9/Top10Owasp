<?php
  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";


  $client_id = $_SESSION['userId'];

  $client_details = "SELECT * FROM client WHERE client_id = ".$client_id;
  $client_last_trans = "SELECT * FROM bookkeeping_c".$client_id." WHERE transaction_id=
  (SELECT MAX(transaction_id) FROM bookkeeping_c".$client_id.")";

  $client_info = $link -> query($client_details);
  $client_data_trans = $link -> query($client_last_trans);


  #get PI
  if($client_info -> num_rows > 0){
    while($row = mysqli_fetch_assoc($client_info)){
      $firstname = $row['firstname'];
      $surname = $row['surname'];
      $d_o_b = $row['d_o_b'];
      $sex = $row['sex'];
      $p_a_n = $row['p_a_n'];
      $email = $row['email'];
      $phone_num = $row['phone_num'];
      $address = $row['address'];
      $account_num = $row['account_num'];
      $sort_code = $row['sort_code'];
      $pin = $row['pin'];
      $username = $row['username'];
      $password = $row['password'];
    }
  }
  # get bank balance
  if($client_data_trans -> num_rows > 0){
    while($row = mysqli_fetch_assoc($client_data_trans)){
      $bank_balance = $row['bank_balance'];
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/profile_layout.css">
</head>
<body>
<div class ="receptacle-background">
    <div class = "receptacle-init">
      <form action = "account_form_update.php" id = "client_form" name = "client_form" method = "post"> <!--*****-->
      <div class = "one">
        <div id = "pi">
          <div class = "form-title">
            <h3>Your Personal Details</h3>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Firstname : <label id = "pi_label"><?php echo ucfirst($firstname) ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Surname : <label id = "pi_label"><?php echo ucfirst($surname) ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Date Of Birth : <label id = "pi_label"><?php echo ucfirst($d_o_b) ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Sex : <label id = "pi_label"><?php echo ucfirst($sex) ?></label></label>
          </div>
        </div>
        <div id="contact">
          <div class = "form-title">
            <h3>How We do Contact You</h3>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Email : </label><input id = "pi_label" name = "email" size = "55" type = "text" value = "<?php echo $email ?>" required />
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label> Contact phone : </label ><input id = "pi_label" name = "phone" size = "15" type = "text" value = "<?php echo $phone_num ?>" required </label>
          </div>
        </div>

        <div id= "residential">
          <div class = "form-title">
            <h3>Your Residential Address</h3>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Address :
<p><?php echo $address; ?></p>
<br/><br/>


<textarea id = "pi_label" rows = "4" cols = "50" name = "address" form = "client_form"><?php echo $address; ?></textarea></label>
          </div>
        </div>
      </div>
      <div class = "two">
        <div id = "pid">
          <div class = "form-title">
            <h3>Your Personal Details</h3>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Primary Account Number(pan) : <label id = "pi_label"><?php echo $p_a_n ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Account Num : <label id = "pi_label"><?php echo $account_num ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Sort Code : <label id = "pi_label"><?php echo $sort_code ?></label></label>
          </div>
        </div>

        <div id = "memo">
          <div class = "form-title">
            <h3>Your Memorable Information</h3>
          </div>
          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Pin : <label id = "pi_label"><?php echo $pin ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Username : <label id = "pi_label"><?php echo $username ?></label></label>
          </div>

          <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
            <label>Password : <label id = "pi_label"><?php echo $password ?></label></label>
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

</div>
<footer>
  <div class ="Copyright">
    <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
  </div>
</footer>
</body>
</html>
