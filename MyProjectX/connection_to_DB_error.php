<?php

  include "header.php";

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/sess_terminated_layout.css">
</head>

<body>

  <div class = "topnav" id = "theTopNav">
  </div>

  <div class = "receptacle-background">
  <div class = "receptacle-init">

    <div class = "rec-init-0">
      <img id = "link" src = "./images/error.png"
    </div>
    <div class = "rec-init-1">
      <h1 id = "link-details">An error has occured while establishing DB connection</h1>
      <p id = "link-details"> There are some issues connecting to the Database</p>
      <p id = "link-error">
        <b>Error Message:</b>
          <?php

            if(isset($_GET['error'])){
              echo $_GET['error'];
            }
          ?>
        <br><br><br><br>
        Please ensure that either the database login credetials and the server is set up properly
        and try again later.
      </p>
    </div>
    <div class = "rec-init">
      <a href = "indexx.php" class = "button"> Go to Homepage</a>
    </div>

  </div>
  </div>

</body>
</html>
