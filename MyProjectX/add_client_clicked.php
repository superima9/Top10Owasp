<?php
  include "connection_to_DB.php";

  if(!isset($_SESSION)){
    session_start();
  }

  include "header.php";
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


  $firstname = $_POST["firstname"];
  $surname = $_POST["surname"];
  $d_o_b = $_POST["d_o_b"];
  $sex = $_POST["sex"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $phone_num = $_POST['phone_num'];
  $p_a_n = $_POST['p_a_n'];
  $account_num = $_POST['account_num'];
  $sort_code = $_POST['sort_code'];
  $pin = $_POST['pin'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql_id = "SELECT MAX(client_id) FROM client";
  $query_id = $link -> query($sql_id);
  $row = $query_id -> fetch_assoc();
  $new_client_id = $row["MAX(client_id)"] + 1;

  $adjust_id = "ALTER TABLE customer AUTO_INCREMENT=".$new_client_id;
  $link->query($adjust_id);


  $sql_new_client = "INSERT INTO client VALUES (DEFAULT , '$firstname', '$surname',
    '$d_o_b', '$sex', '$p_a_n', '$email', '$phone_num', '$address', '$account_num',
    '$sort_code', '$pin', '$username', '$password')";

  $sql_book ="CREATE TABLE bookkeeping_c".$new_client_id."(
              transaction_id INT(12) NOT NULL AUTO_INCREMENT,
              date_time DATETIME,
              description VARCHAR(255),
              money_in FLOAT,
              money_out FLOAT,
              bank_balance INT,
              PRIMARY KEY(transaction_id)
             )";

  $sql_ben ="CREATE TABLE beneficiary_c".$new_client_id."(
            beneficiary_id INT(12) NOT NULL AUTO_INCREMENT,
            beneficiary_client_id INT UNIQUE,
            account_num INT(8) UNIQUE,
            sort_code INT(6) UNIQUE,
            beneficiary_client_full_name VARCHAR(70) UNIQUE,
            beneficiary_saved_us VARCHAR(35),
            PRIMARY KEY(beneficiary_id)
        )";


$sql_start = "INSERT INTO bookkeeping_c".$new_client_id." VALUES(
            DEFAULT,
            NOW(),
            'Opening Balance',
            '1000',
            '0',
            '1000'
        )";

?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/add_client_clicked_layout.css">
</head>

<body>
  <div class ="receptacle-background">
    <div class = "receptacle-init">
      <div class = "rec-init-0">
        <?php if(($link-> query($sql_new_client) === TRUE)){ ?>
                <p><?php echo "The new customer have been added to the table";?><br></p>
           <?php  if(($link-> query($sql_book) === TRUE)){ ?>
                    <p><?php echo "The customer bookeeping's table has been created";?><br></p>
            <?php   if(($link-> query($sql_start) === TRUE)){ ?>
                      <p><?php echo "The customer bookeeping has been initialized"; ?><br></p>
              <?php } else { ?>
                      <?php $message = "Error: <br>".$link->error."<br>"; ?>
                      <p><?php echo "The customer bookeeping was not able to open the balance".$message;?><br></p>
              <?php } ?>
            <?php } else { ?>
              <?php $message1 = "Error: <br>".$link->error."<br>"; ?>
                    <p><?php echo "The customer bookeeping table could not be created".$message1; ?><br></p>
            <?php } ?>
            <?php if(($link-> query($sql_ben) === TRUE)){ ?>
        <p><?php echo "The customer beneficiary's table has been created"; ?><br></p>
           <?php } else { ?>
           <?php $message2 = "Error: <br>".$link->error."<br>"; ?>
          <p><?php echo "The customer beneficiary table could not be created".$message2; ?><br></p>
           <?php } ?>
        <?php } else { ?>
        <?php $message3 = "Error: <br>".$link->error."<br>";?>
        <p><?php echo "Could not add a new customer to the table <br><strong>echo Error: ".$sql_new_client."".$link->error."</strong><br>" ?><br></p>
       <?php } ?>
      </div>

      <div class = "rec-init">
        <a href = "./admin_add_client.php" class = "button">Back</a>
      </div>
      <div class = "rec-init">
        <a href = "./admin_index.php" class = "button">Home page</a>
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
