<?php
include "connection_to_DB.php";
include "header.php";

if(!isset($_SESSION)){
  session_start();
}

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

if(!empty($_GET['clt'])){
  $account = $_GET['clt'];
}

$sql_id = "SELECT * FROM client WHERE account_num = '$account'";
$query_id = $link -> query($sql_id);
if($query_id -> num_rows > 0){
  while($row = mysqli_fetch_assoc($query_id)){
    $client_id = $row['client_id'];
  }
}
$query_list_trans = "SELECT * FROM bookkeeping_c".$client_id;


?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_transactions_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <div class = "receptacle-init">

      <?php
        $transactions = $link->query($query_list_trans);

        if($transactions -> num_rows > 0){?>
          <div class = "recipient-table">
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
                <td><?php echo $rows['transaction_id']; ?></td>
                <td><?php echo $rows['date_time'];?></td>
                <td><?php echo $rows['description'];?></td>
                <td><?php echo $rows['money_in'];?></td>
                <td><?php echo $rows['money_out'];?></td>
                <td><?php echo $rows['bank_balance'];?></td>
              </tr>
          <?php }?>
            </table>
          </div>
        <?php }else{ ?>

          <p id = "no-trans"> You do not have any current transactions</p>

        <?php }
          $link->close();
        ?>
    </div>

    <div class="receptacle-init">
      <div class = "rec-init">
        <a href="admin_manage_client.php" id = "mybtn">Go Back</a>
      </div>
      <div class="rec-init">
        <a href="admin_index.php" id = "mybtn2">Home page</a>
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
