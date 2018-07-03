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
  <link rel = "stylesheet" href = "./css/about_us_layout.css">
</head>

<body>
  <div class = "receptacle-background">

    <div class = "receptacle-init">

      <div class = "rec-init">
        <h2 id = "about-details">Website fully vulnerable</h2>
        <p id = "about-details">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          . Lorem Ipsum has been the industry's standard dummy text ever since the
           1500s, when an unknownLorem Ipsum is simply dummy text of the printing
           typesetting industry Lorem Ipsum is simply dummy text of the printing
            typesetting industry, Lorem Ipsum is simply dummy text of the printin
            typesetting industry, Lorem Ipsum is simply dummy text of the printing
             typesetting industry, Lorem Ipsum is simply dummy text of the printing
             typesetting industry, Lorem Ipsum is simply dummy text of the printing
              typesetting industry, Lorem Ipsum is simply dummy text of the printing
              typesetting industry Lorem Ipsum has been the industry's standard dummy
               text ever since the. Lorem Ipsum is simply dummy text of the printing
               and typesetting industry
               . Lorem Ipsum has.[8][9]
          [10][11].
        </p>
      </div>

      <div class = "rec-init">
        <h2 id = "about-details">Website with security measures</h2>
        <p id = "about-details">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry
          . Lorem Ipsum has been the industry's standard dummy text ever since the
           1500s, when an unknownLorem Ipsum is simply dummy text of the printing
           typesetting industry Lorem Ipsum is simply dummy text of the printing
            typesetting industry, Lorem Ipsum is simply dummy text of the printin
            typesetting industry, Lorem Ipsum is simply dummy text of the printing
             typesetting industry, Lorem Ipsum is simply dummy text of the printing
             typesetting industry, Lorem Ipsum is simply dummy text of the printing
              typesetting industry, Lorem Ipsum is simply dummy text of the printing
              typesetting industry Lorem Ipsum has been the industry's standard dummy
               text ever since the. Lorem Ipsum is simply dummy text of the printing
               and typesetting industry
               . Lorem Ipsum has.[8][9]
          [10][11].
        </p>

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
