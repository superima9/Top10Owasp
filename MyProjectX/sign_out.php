<?php
  include "connection_to_DB.php";

  session_start();
  session_destroy();

  header("location:indexx.php")

?>
