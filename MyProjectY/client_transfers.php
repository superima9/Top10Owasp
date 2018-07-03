<?php

  require_once "connection_to_DB.php";
  include "verify_auth.php";
  include "check_session.php";
  define('Myheader', TRUE);
  define('mynav', TRUE);
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

  if(!empty($_GET['rcv'])){
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($_GET['rcv'])))){

      $receiver = escape_input($_GET['rcv']);
      if(!$receiver === FALSE){
        include_once "encrypt.php";
        $rcv = encrypt('encrypt', $receiver);
        header("location:transfer_money.php?rcv=$rcv");
        exit;
      }

    } else {

      $receiver = FALSE;

    }
  } else {

    $receiver = FALSE;

  }

  if(!empty($_GET['dcv'])){
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($_GET['dcv'])))){

      $receiver = escape_input($_GET['dcv']);
      if(!$receiver === FALSE){
        include_once "encrypt.php";
        $rcv = encrypt('encrypt', $receiver);
        header("location:./del_recipient.php?rcv=$rcv");
        exit;
      }

    } else {

      $receiver = FALSE;

    }
  } else {

    $receiver = FALSE;

  }

  if(isset($_GET['Error_client'])){
    $err = "An error occured, Recipient account is disactivated or deleted";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['Error_import'])){
    $err = "Please review the format for import input and try again.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['Error_token'])){
    $err = "Please enter a correct format for the input fields, and try again.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['Error'])){
    $err = "An error occured, sorry for the inconvenience";
    echo "<script type='text/javascript'>alert('$err');</script>";
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
    header("location:index.php?Error=true");
    exit();

  }

  $sql0 = "SELECT * FROM beneficiary_c".$client_id;
  $sql1 = "SELECT bank_balance FROM bookkeeping_c".$client_id." ORDER BY transaction_id DESC LIMIT 1";
  $sql2 = "SELECT * FROM client where client_id = ".$client_id;

  $query_1 = $link -> query($sql1);
  $query_2 = $link -> query($sql2);

  $row1 = $query_1 -> fetch_assoc();
  $row2 = $query_2 -> fetch_assoc();

  if($query_1 -> num_rows > 0){
    $bank_balance = $row1['bank_balance'];

  } else {
    $log_ids = "store to file";
    header("location:index.php?Error=true");
    exit();
  }

  if($query_2 -> num_rows > 0){
    $account_num = $row2['account_num'];
    $sort_code = $row2['sort_code'];
  } else {
    $log_ids = "store to file";
    header("location:index.php?Error=true");
    exit();
  }
?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/transfers_layout.css">
  <script type="text/javascript" src=".js/jquery-1.12.4.js"></script>
  <script type="text/javascript" src=".js/jquery.dataTables.min.js"></script>
</head>
<body>
  <div class = "receptacle-background">
      <div id = "title" class = "receptacle-init">
        <div id = 'title-init'class = "rec-init">
          <h4 id = "form_title">Payments and Transfers</h4>
        </div>
      </div>

      <div class = "receptacle-init">
        <h3 id = "client.this-info">Sending money from:</h3>
        <div class = "rec-init">
          <p id = "client.this-info">Account details : <?php echo htmlspecialchars($account_num.' '.$sort_code, ENT_NOQUOTES, "UTF-8"); ?></p>
          <p id = "client.this-info">Available funds £ <?php echo htmlspecialchars($bank_balance, ENT_NOQUOTES, "UTF-8"); ?></p>
        </div>
      </div>

      <div id = "to" class = "receptacle-init">


        <h3 id = "client.this-info">Sending money to:</h3>

        <button id = "myBtn">Select Recipient</button>

        <div id = "mybox" class  = "box">
          <div class = "box-receptacle">
            <div class = "box-header">
              <span class = "shut">&times;</span>
              <h2>Your recipients</h2>
            </div>
            <div class = "box-body">
              <?php
                $query_0 = $link -> query($sql0);

                if($query_0 -> num_rows){ ?>
                  <table id = "recipient-table"> <!-- recipient-table -->
                    <tr>
                      <th>Full Name</th>
                      <th>Account Number</th>
                      <th>Sort Code</th>
                      <th>Named Saved us</th>
                      <th>Action</th>
                      <th></th>
                    </tr>
            <?php while($rows = mysqli_fetch_assoc($query_0)){ ?>
                    <tr>
                      <td id = "sel"><?php echo htmlspecialchars($rows['beneficiary_client_full_name'], ENT_NOQUOTES, "UTF-8"); ?></td>
                      <td id = "sel"><?php echo htmlspecialchars($rows['account_num'], ENT_NOQUOTES, "UTF-8");?></td>
                      <td id = "sel"><?php echo htmlspecialchars($rows['sort_code'], ENT_NOQUOTES, "UTF-8");?></td>
                      <td id = "sel"><?php echo htmlspecialchars($rows['beneficiary_saved_us'], ENT_NOQUOTES, "UTF-8");?></td>
                      <td>
                        <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                          <button onclick = "myFunction2()" id = "transfer" disabled>Transfer</button>
                        </div>
                      </td>
                      <td>
                        <button onclick = "myFunction()" id = "delete" disabled>Delete</button>
                      </td>

                    </tr>

            <?php }?>
                  </table>
                  <input type="button" name="OK" class="ok" value="OK"<input type="submit" style="color: transparent; background-color: transparent; border-color: transparent; cursor: default;" disabled/>
          <?php } else { ?>
                <p id = "no-ben"> You do not have any beneficiary</p>
          <?php }
                $link->close();
               ?>
            </div>

          </div>
        </div>

        <button id = "myBtn1">Add new recipient</button>

        <div id = "mybox1" class  = "box1">
          <div class = "box-receptacle1">
            <div class = "box-header1">
              <span class = "shut1">&times;</span>
              <h2>Add a new recipient</h2>
            </div>
            <div class = "box-body1">
              <br>
              <form accept-charset="utf-8" action = "check_new_beneficiary.php" id = "ben_form" name = "ben_form" method = "post" autocomplete="off">
                <div class = "rec-init-rec"> <!--input type require that before submitting,fill out box-->
                  <label id = "ben_label">Firstname : </label>
                  <input name = "firstname" size = "35" maxlength="35" type = "text" value = "" required>
                </div>
                <div class = "rec-init-rec"> <!--input type require that before submitting,fill out box-->
                  <label id = "ben_label">Surname : </label>
                  <input name = "surname" size = "35" maxlength="35" type = "text" value = "" required>
                </div>
                <div class = "rec-init-rec"> <!--input type require that before submitting,fill out box-->
                  <label id = "ben_label">Account Number : </label>
                  <input name = "account_num" size = "8" maxlength="8" type = "text" value = "" required>
                </div>
                <div class = "rec-init-rec"> <!--input type require that before submitting,fill out box-->
                  <label id = "ben_label">Sort Code : </label>
                  <input name = "sort_code" size = "6" maxlength="6" type = "text" value = "" required>
                </div>
                <div class = "rec-init-rec"> <!--input type require that before submitting,fill out box-->
                  <label id = "ben_label">Save name as : </label>
                  <input name = "nickname" size = "35" maxlength="35" type = "text" value = "" required>
                </div>
                <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                  <button id = "myBtn2" type = "submit">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
  var box = document.getElementById('mybox');
  var btn = document.getElementById('myBtn');
  var shut = document.getElementsByClassName('shut')[0];

  btn.onclick = function(){
    box.style.display = "block";
  }

  shut.onclick = function(){
    box.style.display = "none";
  }

  window.onclick = function(event){
    if(event.target == box){
    box.style.display = "none";
    }
  }
</script>
<script>
var box1 = document.getElementById('mybox1');
var btn1 = document.getElementById('myBtn1');
var shut1 = document.getElementsByClassName('shut1')[0];

btn1.onclick = function(){
  box1.style.display = "block";
}

shut1.onclick = function(){
  box1.style.display = "none";
}

window.onclick = function(event){
  if(event.target == box1){
  box1.style.display = "none";
  }
}
</script>
<script>
var answer = false;
var answer2 = false;
var value;

$("#recipient-table tr").click(function(){

    $(this).addClass('selected').siblings().removeClass('selected');

    //$('button').removeAttr("disabled");
    $(this).find('button').attr('disabled', false);
    //i NEED TO MAKE THE BUTTONS UNSELECTABLE UNTIL I GET THE PARAMETER RCV
    value = $(this).find('td:eq(1)').html();

    if((answer != false) && (answer2 != false)){
    window.location = "./transfer_money.php?rcv=" + value;
  }

  //alert(value);
});


$('.ok').on('click', function(e){
    alert($("#recipient-table tr.selected td:first").html());
    //var = "#table tr.selected td:first";
});

function myFunction(){
  answer = confirm("Are you sure you want to delete ?");
  if(answer == true){
    window.location = "./client_transfers.php?dcv=" + value;
  }else{
    answer = false;
  }
}

function myFunction2(){
  answer2 = confirm("Are you sure you want to transfer?");
  if(answer2 == true){
    window.location = "./client_transfers.php?rcv=" + value;
    //window.location = "./transfer_money.php?rcv=" + value;

  }else{
    answer2 = false;
  }
}
</script>
<footer>
  <div class ="Copyright">
    <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
  </div>
</footer>
</body>
</html>
