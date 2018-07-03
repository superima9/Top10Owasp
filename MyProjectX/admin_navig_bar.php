<?php
  include "connection_to_DB.php";

  if(!isset($_SESSION)){
    session_start();
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel=  "stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "./css/admin_navig_bar_layout.css">
  <script src = "jquery-3.2.1.min.js"></script>
</head>
<body>

  <div class = "nav-recepticle">
    <div class = "navigalto" id = "Navigalto">
      <a href = "admin_index.php">Home Page</a>
      <a href = "contact_us.php">Contact Us</a>
      <a href = "about_us.php">About Us</a>
      <a href = "help.php">Help</a>
      <div class="navigbasso">
        <button id = "navigbasso-btn" class = "navigbassobtn">Administration
          <i class="fa fa-caret-down"></i>
        </button>
          <div class="navigbasso-text">
            <a href="./admin_add_client.php">Add new Client</a>
            <a href="./admin_manage_client.php">Manage Clients</a>
          </div>
      </div>
      <a href = "./sign_out.php">Sign Out</a>
    </div>
  </div>
</body>
