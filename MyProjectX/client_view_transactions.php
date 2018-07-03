<?php
  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";

  $client_id = $_SESSION['userId'];

  $query_list_trans = "SELECT * FROM bookkeeping_c".$client_id;

?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/transactions_layout.css">
</head>
<body>
  <div class = "receptacle-background">
    <div class = "receptacle-init">

      <?php
        $transactions  =$link->query($query_list_trans);

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
                <td><?php echo $rows['transaction_id']; ?></td>
                <td><?php echo $rows['date_time'];?></td>
                <td><?php echo $rows['description'];?></td>
                <td><?php echo $rows['money_in'];?></td>
                <td><?php echo $rows['money_out'];?></td>
                <td><?php echo $rows['bank_balance'];?></td>
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
