<?php

  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";


  $import = $_GET['import'];
  //$password  =$_POST['password'];
  $message = "ciao";

  if(!empty($_GET['clt'])){
    $ben_client_id = $_GET['clt'];
  }
  #Sender information table
  $sql = "SELECT * FROM client WHERE client_id = ".$_SESSION['userId']; //AND password ='".$password."'";
  $client_sender_pi = $link -> query($sql);
  $row = mysqli_fetch_assoc($client_sender_pi);
  #Beneficiary information table
  $sqla = "SELECT * FROM client WHERE client_id = ".$ben_client_id;
  $client_ben_pi = $link -> query($sqla);
  $rowa = mysqli_fetch_assoc($client_ben_pi);
  #Check if it is the right password
  if($client_sender_pi -> num_rows > 0){
    $sql1 = "SELECT * FROM bookkeeping_c".$_SESSION['userId']." ORDER BY transaction_id DESC LIMIT 1";
    $query_sender_balance = $link -> query($sql1);
    $row1 = mysqli_fetch_assoc($query_sender_balance);
    ini_set("precision", 3);
    $new_sender_balance = $row1['bank_balance'] - $import;
    #Check if he has sufficient funds
      if($new_sender_balance >= 0){
        $sqlb = "SELECT bank_balance FROM bookkeeping_c".$ben_client_id;
        $query_ben_pi = $link -> query($sqlb);
        $rowb = mysqli_fetch_assoc($query_ben_pi);
        $new_ben_balance = $rowb['bank_balance'] + $import;
        $description_B = "P2P - Received from  ".$row['surname']." ".$row['firstname']." -> AN: ".$row['account_num']." SC:".$row['sort_code'];
        $description_S = "P2P - Transferred to ".$rowa['surname']." ".$rowa['firstname']." -> AN: ".$rowa['account_num']." SC:".$rowa['sort_code'];
        #Update import in the database table sender
        $sql_clt_update = "INSERT INTO bookkeeping_c".$_SESSION['userId']." VALUES(DEFAULT, NOW(), '$description_S  ', '0', '$import', '$new_sender_balance')";
        #  #Update import in the database table beneficiary
        $sql_ben_update = "INSERT INTO bookkeeping_c".$ben_client_id." VALUES(DEFAULT, NOW(), '$description_B', '$import', '0', '$new_ben_balance')";

        if(($link -> query($sql_clt_update) === TRUE) && ($link -> query($sql_ben_update) === TRUE)){
          $message = "Transaction completed successfully";
        }else{
          $message = "Error: <br>".$link->error."<br>";
        }
      }else{
        $message = "Error: Insufficient funds";
      }

  }else{
    $message = "Error: Client not found";
  }


?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/check_transfer_clk_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div class = "rec-init">
      <p><?php echo $message;?></p>
    </div>

    <div class = "rec-init">
      <a href = "client_index.php" class = "button">Home Page</a>
      <a href = "client_transfers.php" class = "button">Payment and transfers</a>
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
