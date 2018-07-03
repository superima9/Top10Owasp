<?php
  if(!defined('mynav')){
    exit("You are not allowed to do that, press Back button on browswer!");
  }
?>
 <?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel=  "stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "./css/client_navig_bar_layout.css">
  <script src = "jquery-3.2.1.min.js"></script>
</head>
<body>
  <div class = "nav-recepticle">
    <div class = "navigalto" id = "Navigalto">
      <a href = "./client_index.php">Home Page</a>
      <a href = "./contact_us.php">Contact Us</a>
      <a href = "./about_us.php">About Us</a>
      <a href = "./help.php">Help</a>
      <div class="navigbasso">
        <button id = "navigbasso-btn" class = "navigbassobtn">Services
          <i class="fa fa-caret-down"></i>
        </button>
          <div class="navigbasso-text">
            <a href="./client_view_transactions.php">View Transactions</a>
            <a href="./client_transfers.php">Transfers & Payments</a>
            <a href="./client_atm.php">ATM Withdraw</a>
          </div>
      </div>
      <a href="./client_my_account.php">My Account</a>
      <a href = "./sign_out.php">Sign Out</a>
    </div>
  </div>
</body>
</html>
