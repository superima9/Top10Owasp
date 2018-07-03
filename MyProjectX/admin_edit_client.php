<?php

include "connection_to_DB.php";
include "header.php";

if(!isset($_SESSION)){
  session_start();
}

if(isset($_SESSION['loggedIn'])){
  $chesh = $_SESSION['admin'];
  if($chesh === true){
    include "admin_navig_bar.php";
  }else{
  include "client_navig_bar.php";
  }
}else{
  include "navig_bar.php";
}

if(!empty($_GET['clt'])){
  $account = $_GET['clt'];
}

$sql_id = "SELECT * FROM client WHERE account_num = '$account'";
$query_id = $link -> query($sql_id);
if($query_id -> num_rows > 0){
  while($row = mysqli_fetch_assoc($query_id)){
    $client_id = $row['client_id'];
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
    $username = $row['username'];  #check if using a variable with same name in different files interfere
    $password = $row['password'];
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <!--Scale down the webpage to fit whatever device-->
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_edit_client_layout.css">

</head>
<body>
<div class ="receptacle-background">
  <div class= "receptacle-init">
    <div class = "rec-init">
      <form action = "admin_account_form_update.php?clt=<?php echo $client_id;?>" id = "admin_client_form" name = "admin_client_form" method = "post"> <!--*****-->
        <div class = "one">
          <div id = "pi">
            <div class = "form-title">
              <h3>Your Personal Details</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Client ID : <label id = "pi_label"><?php echo $client_id;?></label></label>
            </div>
            <!-- Unchangeable -->
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Firstname : </label><input id = "pi_label" name = "firstname" size = "35" type = "text" value = "<?php echo ucfirst($firstname); ?>" required>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Surname : </label> <input id = "pi_label" name = "surname" size = "35" type = "text" value = "<?php echo ucfirst($surname); ?>" required>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Date Of Birth : </label> <input id = "pi_label" name = "d_o_b" size = "35" type = "text" value = "<?php echo $d_o_b; ?>" required>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Sex : </label>
              <input type="radio" name="sex" value="male" checked> Male <br>
              &emsp;&emsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="female"> Female <br>
            </div>
          </div>
          <div id = "contact">
            <!-- finished uncheangeable -->
            <div class = "form-title">
              <h3>How We do Contact You</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "pi_label">Email : </label><input id = "pi_label" name = "email" size = "35" type = "text" value = "<?php echo $email; ?>" required>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "pi_label">Contact phone : </label ><input id = "pi_label" name = "phone_num" size = "14" type = "text" value = "<?php echo $phone_num; ?>" required></label>
            </div>
          </div>
          <div id = "residential">
            <div class = "form-title">
              <h3>Your Residential Address</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Address : <textarea id = "pi_label" rows = "4" cols = "50" name = "address" form = "admin_client_form"><?php echo $address; ?></textarea></label>
            </div>
          </div>
        </div>
        <div class = "two">
          <div id = "pid">
            <div class = "form-title">
              <h3>Your Personal Details</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Primary Account Number(pan) : </label> <input id = "pi_label" name = "p_a_n" size = "19" type = "text" value = "<?php echo $p_a_n; ?>" required>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Account Num : </label> <input id = "pi_label" name = "account_num" size = "8" type = "text" value = "<?php echo $account_num; ?>" required>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Sort Code : </label> <input id = "pi_label" name = "sort_code" size = "6" type = "text" value = "<?php echo $sort_code; ?>" required>
            </div>
          </div>
          <div id = "memo">
            <div class = "form-title">
              <h3>Your Memorable Information</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Pin : </label> <input id = "pi_label" name = "pin" size = "4" type = "text" value = "<?php echo $pin; ?>" required>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Username : </label> <input id = "pi_label" name = "username" size = "25" type = "text" value = "<?php echo $username; ?>" required>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label>Password : </label> <input id = "pi_label" name = "password" size = "35" type = "text" value = "<?php echo $password; ?>" required>
            </div>
          </div>
          <div id = "press">
            <div class = "form-title">
              <h3>Perform an action ???</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <button type = "submit">Update Details
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
