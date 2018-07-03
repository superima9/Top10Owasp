<?php

  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";

  $sql1 = "SELECT bank_balance FROM bookkeeping_c".$_SESSION['userId'];
  $receiver = "ciao";
  $query_1 = $link -> query($sql1);
  $row1 = $query_1 -> fetch_assoc();

  if($query_1 -> num_rows > 0){
    $bank_balance = $row1['bank_balance'];
  }

  if(!empty($_GET['rcv'])){
    $receiver = $_GET['rcv'];
  } else {
    session_destroy();
    header("location:index.php?Error=true");
  }

  $firstname_r = "coap";
  $sql0 = "SELECT * FROM client WHERE account_num ='$receiver'";
  $query_0 = $link -> query($sql0);
  if($query_0 -> num_rows > 0){
    while($row = mysqli_fetch_assoc($query_0)){
      $account_num_r = $row['account_num'];
      $client_id_r = $row['client_id'];
      $sort_code_r = $row['sort_code'];
      $firstname_r = $row['firstname'];
      $surname_r = $row['surname'];
    }
  }


?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/client_transfers_clicked.css">
</head>

<body>
  <div class = "receptacle-background">
    <form class = "tranfer_money" action = "check_transfer.php" method = "get">
      <div id = "title" class = "receptacle-init">
        <div id = 'title-init'class = "rec-init">
        <h4 id = "form_title">Payments and Transfers</h4>
        </div>
      </div>

      <div class = "receptacle-init">
        <div class = "rec-init">
          <h3>Available Balance: <?php echo $bank_balance ?></h3>
        </div>
      </div>

      <div class = "receptacle-init">
        <h3 id = "client.this-info">Sending money to:</h3>
        <div class = "rec-init">
          <p id = "client.this-info">Recipient:<?php echo $firstname_r." ".$surname_r ?></p>
          <p id = "client.this-info">AN:<?php echo $account_num_r; ?></p>
          <p id = "client.this-info">SC:<?php echo $sort_code_r; ?></p>
        </div>
      </div>

        <div id = "pay-back" class = "receptacle-init">
          <div class = "pay-back"> <!--input type require that before submitting,fill out box-->
            <label id = "pi_label">Enter import: £ </label><input name = "import" size = "35" type = "" value = "00.00" required />

            <input type = "hidden" name = "clt" value = "<?php echo $client_id_r?>" >

        <!--  <label id = "pi_label">Enter Password: </label><input name = "password" size = "35" type = "" placeholder = "Enter password" required />-->
            <div id = "pay"class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <button id = "myBtn" type = "submit">Pay Recipient</button>
            </div>
            <div id = "pay" class = "rec-init"> <!--input type require that before submitting,fill out box-->
              <a id = "myBtn1" href = "./client_index.php" class = "back-btn">Cancel</a>  <!-- you want to go back to the page where they have sthe list of recip tho -->
            </div>
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
