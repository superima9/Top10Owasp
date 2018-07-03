<?php
  include "connection_to_DB.php";
  include "header.php";
  include "client_navig_bar.php";

  $client_id = $_SESSION['userId'];
?>

<!DOCTYPE html>
<html>
<body>
<?php echo "sss".$client_id; ?>
  <div class ="receptacle-background">

      <form action = "change_credentials.php?ibgs=7375" class = "client_form" method = "post"> <!--*****-->
        <div class = "form-title">
          <h2>Change Address</h2>
        </div>

        <div class="recepticle-int">
            <div class=rec-init>
                <label>Address line 1:</b></label><br>
                <input name="add-1" size="35" type="add-1" required />
            </div>
        </div>

        <div class="recipticle-init">
            <div class= "rec-int">
                <label>Address line 2:</label><br>
                <input name="add-2" size="35" type="add-2" required />
            </div>
            <div  class= "rec-init">
                <label>City:</b></label><br>
                <input name="add-3" size="35" type="add-3" required />
            </div>
            <div  class= "rec-init">
                <label>Post Code:</b></label><br>
                <input name="add-4" size="35" type="add-4" required />
            </div>

        </div>

        <div class="recipticle-init">
            <div class="rec-init">
                <a href="client_my_account.php" class="button">Back</a>
            </div>
            <div class="rec-init">
                <button type="submit">Submit</button>
            </div>
        </div>
      </form>
  </div>
  <footer>
    <div class ="Copyright">
	   	<p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
	    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
	  </div>
  </footer>
</body>
</html>
