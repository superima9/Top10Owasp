<?php

  include "connection_to_DB.php";
  include "header.php";
  include "admin_navig_bar.php";

  if(!isset($_SESSION)){
    session_start();
  }

  ?>


  <!DOCTYPE html>
  <html>
  <head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <link rel = "stylesheet" href = "./css/admin_index_layout.css">
  </head>
  <body>

  <div class = "receptacle-background">
    <div class = "receptacle-init">
      <img src= "./images/handshacke.jpeg" style="width:100%">
        <div class = "rec-init">
          <h2> <?php echo "HELLO ADMIN" ?></h2>
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
