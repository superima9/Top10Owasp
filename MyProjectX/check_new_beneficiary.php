<?php

  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";

  $client_id = $_SESSION['userId'];

  $firstname = $_POST["firstname"];
  $surname = $_POST["surname"];
  $account_num = $_POST['account_num'];
  $sort_code = $_POST['sort_code'];
  $nickname = $_POST['nickname'];

  $message = "undefined";
  $verify = "SELECT * FROM client WHERE account_num = '".$account_num."' AND sort_code = '".$sort_code."'";

  $query_ben = $link -> query($verify);
  $row = $query_ben-> fetch_assoc();

  if($query_ben -> num_rows){
    $fullname = $row['firstname'].' '.$row['surname'];
    $ben_id = $row['client_id'];
    $message = "successfully";
    if($client_id != $row['client_id']){
      $insert = "INSERT INTO beneficiary_c".$client_id." VALUES (DEFAULT, '$ben_id', '$account_num', '$sort_code', '$fullname', '$nickname')";
      if (($link-> query($insert) === TRUE)){
          $message = "Recipient successfully saved";
      }else{
        #$message = "Recipient not saved due to error db..Try again later";
         $message = "Error: <br>".$link->error."<br>";
      }
    }else{
    $message = "Cannot save yourself as a beneficiary";
    }
  }else{
    $message = "Recipient not recongnized!";
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/update_profile_layout.css">
</head>
<body>
  <div class = "receptacle-init">
    <div id = "init" class = "rec-init">
      <h3><?php echo $message; ?></h3>
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
