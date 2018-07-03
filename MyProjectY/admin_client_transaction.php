<?php
  require_once "connection_to_DB.php";
  define('Myheader', TRUE);
  define('mynav', TRUE);
  include "header.php";
  include "verify_auth.php";
  include "check_session.php";

  if(isset($_SESSION['loggedIn'])){
    $chesh = $_SESSION['admin'];
    if($chesh === true){
      include "admin_navig_bar.php";
    }else{
      include "client_navig_bar.php";
      $log_ids = "store to file";
      session_destroy();
      header("location:index.php?Error=true");
      exit();
    }
  } else {
    include "navig_bar.php";
    $log_ids = "store to file";
    session_destroy();
    header("location:index.php?Error=true");
    exit();
  }

  if(!empty($_GET['clt'])){
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($_GET['clt'])))){

      $account = escape_input($_GET['clt']);

    } else {

      $account = FALSE;

    }
  } else {

    $account = FALSE;

  }

  if($account != FALSE){
    $sql_id = "SELECT * FROM client WHERE account_num = '$account'";
    $query_id = $link -> query($sql_id);
    if($query_id -> num_rows > 0){
      while($row = mysqli_fetch_assoc($query_id)){
        $client_id = $row['client_id'];
      }
    }
    $query_list_trans = "SELECT * FROM bookkeeping_c".$client_id;
  } else {
    $log_error = "store to file";
    header("location:admin_manage_client.php?Error=true");
    exit();
  }
?>

<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
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
                <td><?php echo htmlspecialchars($rows['transaction_id'], ENT_NOQUOTES, "UTF-8"); ?></td>
                <td><?php echo htmlspecialchars($rows['date_time'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['description'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['money_in'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['money_out'], ENT_NOQUOTES, "UTF-8");?></td>
                <td><?php echo htmlspecialchars($rows['bank_balance'], ENT_NOQUOTES, "UTF-8");?></td>
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

    <div id = "button" class="receptacle-init">
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
