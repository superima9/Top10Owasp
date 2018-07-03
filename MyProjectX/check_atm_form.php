<?php

include "connection_to_DB.php";
include "header.php";
include "client_navig_bar.php";

$import = $_POST['import'];
$pin  =$_POST['pin'];
$message = "ciao";


#Sender information table
$sql = "SELECT * FROM client WHERE client_id = ".$_SESSION['userId']." AND pin ='".$pin."'";
$client_sender_pi = $link -> query($sql);
$row = mysqli_fetch_assoc($client_sender_pi);

#Check if it is the right password
if($client_sender_pi -> num_rows > 0){
  $sql1 = "SELECT * FROM bookkeeping_c".$_SESSION['userId']." ORDER BY transaction_id DESC LIMIT 1";
  $query_sender_balance = $link -> query($sql1);
  $row1 = mysqli_fetch_assoc($query_sender_balance);
  $new_sender_balance = $row1['bank_balance'] - $import;
  #Check if he has sufficient funds
    if($new_sender_balance >= 0){
      $description_self = "P2P - Cash withdrawl  ".$row['surname']." ".$row['firstname']." -> AN: ".$row['account_num']." SC:".$row['sort_code'];
      #Update import in the database table sender
      $sql_self_update = "INSERT INTO bookkeeping_c".$_SESSION['userId']." VALUES(DEFAULT, NOW(), '$description_self  ', '0', '$import', '$new_sender_balance')";

      if($link -> query($sql_self_update) === TRUE) {
        $message = "Transaction completed successfully";
      }else{
        $message = "Error: <br>".$link->error."<br>";
      }
    }else{
      $message = "Error: Insufficient funds";
    }

}else{
  $message = "Error: You have not entered the correct password";
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/check_atm_form_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <p><?php echo $message;?></p>
    <div class = "rec-init">
      <a href = "client_index.php" class = "button">Home Page</a>
      <a href = "client_transfers.php" class = "button">Payment and transfers</a>
    </div>
    <footer>
      <div class ="Copyright">
  	   	<p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
  	    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
  	  </div>
    </footer>
</body>
</html>
