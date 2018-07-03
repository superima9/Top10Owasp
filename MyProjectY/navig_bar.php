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
  <link rel = "stylesheet" href = "./css/navig_bar_layout.css">
  <script src = "jquery-3.2.1.min.js"></script>
</head>
<body>
  <div class = "nav-recepticle">
    <div class = "navigalto" id = "Navigalto">
      <a href = "./index.php">Home Page</a>
      <a href = "./contact_us.php">Contact Us</a>
      <a href = "./about_us.php">About Us</a>
      <a href = "./help.php">Help</a>
    </div>
  </div>
</body>
</html>
