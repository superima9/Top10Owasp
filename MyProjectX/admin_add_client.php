<?php
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
?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/add_client_layout.css">

</head>
<body>
<div class ="receptacle-background">
  <div class= "receptacle-init">
    <div class = "rec-init">
      <form action = "add_client_clicked.php" id = "add_client_form" name = "add_client_form" method = "post"> <!--*****-->
        <div class = "one">
          <div id = "pi">
            <div class = "form-title">
              <h3>Your Personal Details</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Firstname : </label><input name = "firstname" size = "35" type = "text" value = "" required> </label>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Surname : </label><input name = "surname" size = "35" type = "text" value = "" required></label>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Date of birth : </label><input name = "d_o_b" size = "10" type = "text" value = "" placeholder = "yyyy-mm-dd" required></label>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Sex : </label>
              <input type="radio" name="sex" value="male" checked> Male <br>
              &emsp;&emsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="female"> Female <br>
            </div>
          </div>
          <div id="contact">
            <div class = "form-title">
              <h3>How We do Contact You</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Email : </label><input name = "email" size = "35" type = "text" value = "" required></label>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Contact phone : </label><input name = "phone_num" size = "15" type = "text" value = "" required></label>
            </div>
          </div>
          <div id = "residential">
            <div class = "form-title">
              <h3>Your Residential Address</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Address : <textarea rows = "4" cols = "50" name = "address" form = "add_client_form" value = "" required></textarea></label>
            </div>
          </div>
        </div>

        <div class = "two">
          <div id = "pid">
            <div class = "form-title">
              <h3>Your Personal Details</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Primary Account Number(pan) : </label><input name = "p_a_n" size = "19" type = "text" value = "" required></label>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Account Num : </label><input name = "account_num" size = "8" type = "text" value = "" required></label>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Sort Code : </label><input name = "sort_code" size = "" type = "text" value = "" required></label>
            </div>
          <div id = "memo">
            <div class = "form-title">
              <h3>Your Memorable Information</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">PIN : </label><input name = "pin" size = "4" type = "text" value = "" required></label>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Username : </label><input name = "username" size = "35" type = "text" value = "" required></label>
            </div>

            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <label id = "add_label">Password : </label><input name = "password" size = "35" type = "text" value = "" required></label>
            </div>
          </div>
          <div id = "press">
            <div class = "form-title">
              <h3>Perform an action ???</h3>
            </div>
            <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <button id = "myBtn" type = "submit">Add Client
            </div>
          </div>
        </div>
      </form>
    </div>
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
