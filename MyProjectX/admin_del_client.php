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
  $account_num = $_GET['clt'];
}

$sql1 = "SELECT client_id FROM client WHERE account_num = '".$account_num."'";

$query_id = $link -> query($sql1);
  if($query_id -> num_rows > 0){
    while($row = mysqli_fetch_assoc($query_id)){
      $client_id = $row['client_id'];
    }
  }
$sql0 = "DELETE FROM client WHERE client_id = '".$client_id."'";
$sql2 = "DROP TABLE bookkeeping_c".$client_id;
$sql3 = "DROP TABLE beneficiary_c".$client_id;

?>


<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_del_layout.css">
</head>
<body>
  <div class="receptacle-background">
    <div class="recipient-init">
      <div class="rec-init">
          <?php
              if (($link->query($sql0) === TRUE)) { ?>
                  <p><?php echo "The Client has been deleted"; ?></p>
       <?php  } else { ?>
                  <p id="info"><?php echo "Could not delete client.A problem occured, try again leter -> echo Error: ".$sql0."<br>".$link->error."<br>"; ?></p>
       <?php  }  ?>
      </div>

      <div class="rec-init">
          <?php
              if (($link->query($sql2) === TRUE)) { ?>
                  <p><?php echo "The Client bookeeping table has been deleted"; ?></p>
       <?php  } else { ?>
                  <p><?php echo "Could not delete bookeeping table.A problem occured, try again leter -> echo Error: ".$sql2."<br>".$link->error."<br>"; ?></p>
       <?php  }  ?>
      </div>

      <div class="rec-init">
        <?php
            if (($link->query($sql3) === TRUE)) { ?>
                <p><?php echo "The Client beneficiary table has been deleted"; ?></p>
     <?php  } else { ?>
                <p><?php echo "Could not delete beneficiary table. A problem occured, try again leter -> echo Error: ".$sql2."<br>".$link->error."<br>"; ?></p>
     <?php  }  ?>
      </div>
      <?php
      $link->close(); ?>
    </div>

    <div class  ="recipient-init">
      <div class = "rec-init">
        <a href = "admin_index.php" class = "button">Home Page</a>
        <a href = "admin_manage_client.php" class = "button">Manage Clients</a>
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
