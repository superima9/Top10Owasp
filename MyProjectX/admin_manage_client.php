<?php

  include "connection_to_DB.php";
  include "header.php";
  include "admin_navig_bar.php";


  $sql0 = "SELECT * FROM client";

?>

<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/transfers_layout.css">
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
                  <td id = "sel"><?php echo $rows['firstname']; ?></td>
                  <td id = "sel"><?php echo $rows['surname'];?></td>
                  <td id = "sel"><?php echo $rows['d_o_b'];?></td>
                  <td id = "sel"><?php echo $rows['account_num'];?></td>
                  <td id = "sel"><?php echo $rows['sort_code'];?></td>
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
    <?php }else{ ?>
          <p id = "no-ben"> You do not have any client</p>
    <?php }
          $link->close();
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
    window.location = "./admin_del_client.php?clt=" + value;
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
