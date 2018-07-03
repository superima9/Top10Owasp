<?php

  include "header.php";
  include "client_navig_bar.php";

  $id = $_SESSION['userId'];

  $sql = "SELECT firstname, surname, sex FROM client WHERE client_id =".$id;
  $whoami = $link -> query($sql);
  $row = mysqli_fetch_assoc($whoami);
  $title = "Dear";
  if($whoami -> num_rows > 0){
    $sex = $row['sex'];
    $fullname = $row['firstname']." ".$row['surname'];
    if($sex == 'male'){
      $title = "Mister ";
    }else if($sex == 'female'){
      $title = "Miss ";
    }else{

    }
  }

  $punchline = "Welcome back ".$title." ".$fullname.".";

?>


<!DOCTYPE html>
<html>
<head>
  <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
  <link rel = "stylesheet" href = "./css/client_index_layout.css">
</head>
<body>

<div class = "receptacle-background">
  <div class = "receptacle-init">
    <img src= "./images/panchina.jpg" style="width:100%">
      <div class = "rec-init">
        <h2> <?php echo $punchline; ?></h2>
      </div>
  </div>
</div>
<div class = "footer">
<footer>
  <div class ="Copyright">
    <p>Copyright&copy;2018 by Ofori Mintah Emmanuel. All rights reserved.</p>
    <p>&reg;&#153;The page was last update on 16 of May of 2018.</p>
  </div>
</footer>
</div>
</body>
</html>
