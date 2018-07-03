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

  $sql0 = "SELECT * FROM client";

  if(isset($_GET['Error'])){
    $err = "An error occured, sorry for the inconvenience";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

  if(isset($_GET['IncorrectToken'])){
    $err = "Please enter a valid new token.";
    echo "<script type='text/javascript'>alert('$err');</script>";
  }

?>
<?php header("Content-Type: text/html; charset=utf-8"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content = "text/html" charset="utf-8">
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/admin_manage_client_layout.css">
  <script type="text/javascript" src="./js/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
</head>
<body>
  <div class = "receptacle-background">
    <div id = "myClient_list" class  = "myClient_list">
          <?php
          $query_all = $link -> query($sql0);
            if($query_all -> num_rows > 0){ ?>
              <table id = "recipient-table"> <!-- recipient-table -->
                <tr>
                  <th>Firstname</th>
                  <th>Surname</th>
                  <th>Date of birth</th>
                  <th>Account Number</th>
                  <th>Sort Code</th>
                </tr>
        <?php while($rows = mysqli_fetch_assoc($query_all)){ ?>
                <tr>
                  <td id = "sel"><?php echo htmlspecialchars($rows['firstname'], ENT_NOQUOTES, "UTF-8"); ?></td>
                  <td id = "sel"><?php echo htmlspecialchars($rows['surname'], ENT_NOQUOTES, "UTF-8");?></td>
                  <td id = "sel"><?php echo htmlspecialchars($rows['d_o_b'], ENT_NOQUOTES, "UTF-8");?></td>
                  <td id = "sel"><?php echo htmlspecialchars($rows['account_num'], ENT_NOQUOTES, "UTF-8");?></td>
                  <td id = "sel"><?php echo htmlspecialchars($rows['sort_code'], ENT_NOQUOTES, "UTF-8");?></td>
                  <td>
                      <div class = "rec-init"> <!--input type require that before submitting,fill out box-->
                        <button onclick = "edit()" id = "edit">Edit Profile</button>
                      </div>
                  </td>
                  <td>
                      <div class = "rec-init">
                        <button onclick = "delete_Client()" id = "delete">Delete Client</button>
                      </div>
                  </td>
                  <td>
                    <button onclick = "transactions()" id = "transactions">View transactions</button>
                  </td>
                </tr>
        <?php }?>
              </table>
            <input type="button" name="OK" class="ok" value="OK" style="color: transparent; background-color: transparent; border-color: transparent; cursor: default;" disabled/>
    <?php } else { ?>
          <p id = "no-ben"> You do not have any client</p>
    <?php }
          $link-> close();
         ?>
       </div>
  </div>
<script>

var answer = false;

var value;
$("#recipient-table tr").click(function(){
  $(this).addClass('selected').siblings().removeClass('selected');
  //i NEED TO MAKE THE BUTTONS UNSELECTABLE UNTIL I GET THE PARAMETER RCV
  value = $(this).find('td:eq(3)').html();
//  if(answer != false && (answer2 != false)){
  //  window.location = "./transfer_money.php?rcv=" + value;
  //}
  //alert(value);
});


$('.ok').on('click', function(e){
    alert($("#recipient-table tr.selected td:first").html());
    //var = "#table tr.selected td:first";
});

</script>

<script>
function delete_Client(){
  answer = confirm("Are you sure you want to delete ?");
  if(answer == true){
    window.location = "./admin_check_delete.php?clt=" + value;
  } else {
    answer = false;
  }
}
</script>

<script>
function edit(){
    window.location = "./admin_edit_client.php?clt=" + value;
}
</script>
<script>
function transactions(){
    window.location = "./admin_client_transaction.php?clt=" + value;
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
