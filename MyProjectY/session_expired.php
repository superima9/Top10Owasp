<?php
  define('mynav', TRUE);
  define('Myheader', TRUE);
  include "header.php";
  include "navig_bar.php";

?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/session_expired_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <div class = "receptacle-title">
        <h2>Session Timeout</h2>
      </div>
      <div class = "text">
        <p>For security reasons and in order to protect your privacy, the session will timeout in onloadedmetadata
          5 minutes of. If you you still want to use your online banking, please click the button below.</p>
      </div>
    </div>
    <div class = "rec-init">
      <a id = "a" href = "index.php" class = "button">Home Page</a>
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
