<?php

  require_once("../DBConfiguration.php");

  if ($link = mysqli_connect(dbhost, dbuser, dbpass)){

  //Handling errors
    if(!mysqli_select_db($link, dbname)){ //check if it managed to select the database
      die("Could not select the database. <br>".mysqli_connect_error($link));

      exit();

    } else {
      if(!$link->set_charset("utf-8")){
        $result = "error loading utf-8";
      } else{
        $result = " utf-8 set";

      }
    }

  } else {

    die("Could not connect to MySQL. <br>".mysqli_connect_error($link));

    exit();
  }


  // delete any malicious input injection
  function escape_input($input){

    if (function_exists('mysqli_real_escape_string')) {

      global $link;
      $input = mysqli_real_escape_string($link,trim($input));
      $input = strip_tags($input);

    } else {

      $input = mysqli_escape_string($link, trim($input));
      $input = strip_tags($input);

    }

    return $input;

  }


?>
