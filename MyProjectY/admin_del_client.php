<?php
  require_once "connection_to_DB.php";
  define('Myheader', TRUE);
  define('mynav', TRUE);
  include "header.php";
  include "verify_auth.php";
  include "check_session.php";
  include_once "encrypt.php";

  if(isset($_SESSION['loggedIn'])){
    $capo = $_SESSION['admin'];
    if($capo === true){
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

    $account_num = encrypt('decrypt', $_GET['clt']);
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($account_num)))){

      $account_num = escape_input($account_num);

    } else {

      $account_num = FALSE;

    }
  } else {

    $account_num = FALSE;

  }

  if($account_num == FALSE){
    header("location:admin_index.php?Error=true");
    exit();
  } else {

    $sql1 = "SELECT client_id FROM client WHERE account_num = ?";
    $client_id = 0;
    $success = false;

    if($stmt = mysqli_prepare($link, $sql1)){

      mysqli_stmt_bind_param($stmt, "s", $param_account);
      $param_account = $account_num;

      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
          mysqli_stmt_bind_result($stmt, $client_id_r);
          if(mysqli_stmt_fetch($stmt)){
            $client_id = $client_id_r;
            $success = true;
          } else {
            $success = false;
          }
        } else {
          $success = false;
          $log_error = "store to file";
          header("location:admin_index.php?Error=true");
          exit();
        }
      } else {
        $success = false;
        $log_error = "store to file";
        header("location:admin_index.php?Error=true");
        exit();
      }
    } else {
      $success = false;
      $log_error = "store to file";
      header("location:admin_index.php?Error=true");
      exit();
    }

    mysqli_stmt_close($stmt);

    $sql0 = "DELETE FROM client WHERE client_id = '".$client_id."'";
    $sql2 = "DROP TABLE bookkeeping_c".$client_id;
    $sql3 = "DROP TABLE beneficiary_c".$client_id;

  }




?>

<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_del_layout.css">

</head>

<body>

  <div class="receptacle-background">
    <div class="recipient-init">
      <div class="rec-init">
          <?php
          if($success == true){
            if (($link->query($sql0) === TRUE)) { ?>
                <p><?php echo htmlspecialchars("The Client has been deleted", ENT_NOQUOTES, "UTF-8"); ?></p>
     <?php  } else { ?>
                <p id="info"><?php echo htmlspecialchars("Could not delete client.A problem occured, try again leter -> echo Error: ".$sql0."<br>".$link->error."<br>", ENT_NOQUOTES, "UTF-8"); ?></p>
     <?php  }  ?>
      </div>
      <div class="rec-init">
          <?php
              if (($link->query($sql2) === TRUE)) { ?>
                  <p><?php echo htmlspecialchars("The Client bookeeping table has been deleted", ENT_NOQUOTES, "UTF-8"); ?></p>
       <?php  } else { ?>
                  <p><?php echo htmlspecialchars("Could not delete bookeeping table.A problem occured, try again leter -> echo Error: ".$sql2."<br>".$link->error."<br>", ENT_NOQUOTES, "UTF-8"); ?></p>
       <?php  }  ?>
      </div>
      <div class="rec-init">
        <?php
            if (($link->query($sql3) === TRUE)) { ?>
                <p><?php echo htmlspecialchars("The Client beneficiary table has been deleted", ENT_NOQUOTES, "UTF-8"); ?></p>
     <?php  } else { ?>
                <p><?php echo htmlspecialchars("Could not delete beneficiary table. A problem occured, try again leter -> echo Error: ".$sql2."<br>".$link->error."<br>", ENT_NOQUOTES, "UTF-8"); ?></p>
     <?php  }  ?>
      </div>
      <?php
      $link->close(); ?>
    </div>

  <?php   } else { ?>
                <p><?php echo htmlspecialchars("Client could not be deleted", ENT_NOQUOTES, "UTF-8"); ?></p>
 <?php    } ?>
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
