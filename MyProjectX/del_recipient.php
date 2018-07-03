<?php

include "connection_to_DB.php";
include "header.php";
include "client_navig_bar.php";

if(!empty($_GET['rcv'])){
  $receiver = $_GET['rcv'];
}

$sql0 = "DELETE FROM beneficiary_c".$_SESSION['userId']." WHERE account_num = '".$receiver."'";
$message = "ciao";

if(($link -> query($sql0) === TRUE)){
  $message = "Deleted the recipient successfully";
}else{
  $message = "A problem occured, try again leter";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/del_recipient_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <h3><?php echo $message;?></h3>
    </div>

    <div class = "rec-init">
      <a id = "a" href = "client_index.php" class = "button">Home Page</a>
      <a href = "client_transfers.php" class = "button">Payment and transfers</a>
    </div>
</body>
<footer>
  <div class ="Copyright">
    <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
  </div>
</footer>
</html>
