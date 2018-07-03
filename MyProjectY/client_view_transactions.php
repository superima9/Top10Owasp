<?php

  require_once("connection_to_DB.php");
  include "verify_auth.php";
  include "check_session.php";
  define('mynav', TRUE);
  define('Myheader', TRUE);
  include "header.php";
  if(isset($_SESSION['loggedIn'])){
    $chesh = $_SESSION['admin'];
    if($chesh === true){
      include "admin_navig_bar.php";
      $log_ids = "store to file";
      session_destroy();
      header("location:index.php?Error=true");
      exit();
    }else{
      include "client_navig_bar.php";
    }
  } else {
    include "navig_bar.php";
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  $client_id = $_SESSION['userId'];

  if(preg_match ('%^[0-9]{1,4}$%', stripslashes(trim($client_id)))){

    $client_id = escape_input($client_id);

  } else {

    $client_id = FALSE;

  }

  if($client_id == FALSE){
    $log_ids = "store to a file";
    if(!isset($_SESSION)){
      session_start();
    }
    session_destroy();
    header("location:index.php");
    exit();

  } else {

    $query_list_trans = "SELECT * FROM bookkeeping_c".$client_id;

  }

?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/transactions_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <div class = "receptacle-init">
      <?php
        $transactions = $link->query($query_list_trans);

        if($transactions -> num_rows > 0){?>
            <table id = "transactions-details">
              <tr>
                <th>Transaction_id</th>
                <th>Date_time</th>
                <th>Description</th>
                <th>Money_in</th>
                <th>Money_out</th>
                <th>bank_balance</th>
              </tr>
          <?php
          while($rows = mysqli_fetch_assoc($transactions)){ ?>
              <tr>
                <td><?php echo htmlspecialchars($rows['transaction_id'], ENT_NOQUOTES, "UTF-8"); ?></td>
                <td><?php echo htmlspecialchars($rows['date_time'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['description'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['money_in'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['money_out'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['bank_balance'], ENT_NOQUOTES, "UTF-8");?></td>
              </tr>
          <?php }?>
            </table>
        <?php }else{ ?>
          <p id = "no-trans"> You do not have any current transactions</p>
        <?php }
          $link->close();
        ?>
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
