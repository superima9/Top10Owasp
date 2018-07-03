<?php

  require_once "connection_to_DB.php";

  if(!isset($_SESSION)){
    session_start();
  }

  //change with check if post is submitted
  if(isset($_POST['submitted'])){
    $recaptcha = false;
    $secret_Key = "6LfF41EUAAAAALAzO0VfrrBZ-VB3OntWDGhUJvzs";
    $response_Key = $_POST["g-recaptcha-response"];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_Key&response=$response_Key&remoteip=$userIP";

    $response = file_get_contents($url);
    $response = json_decode($response);

    if($response->success){
      $recaptcha = true;
    } else {
      $recaptcha = false;
    }
  } else {
    $recaptcha = false;
  }

  if(preg_match ('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['client_username'])))){

    $user = escape_input($_POST['client_username']);

  } else {

    $user = FALSE;
    //echo error invalid

  }

  if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['client_password'])))){

    $pwd = escape_input($_POST['client_password']);

  } else {

    $pwd = FALSE;
    //echo error invalid

  }

  if($user && $pwd && $recaptcha){

    if($user != "administrator"){

      $sql_req = "SELECT username, password, client_id FROM client WHERE username = ?"; //change order for impredivibile
      if($stmt = mysqli_prepare($link, $sql_req)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $user;
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          //check if username and password exist
          if(mysqli_stmt_num_rows($stmt) == 1){
            //Bind result variables
            mysqli_stmt_bind_result($stmt, $username, $hashed_password, $client_id);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($pwd, $hashed_password)){
                //the pwd is correct, so start new session
                $_SESSION['admin'] = false;
                $_SESSION['loggedIn'] = true;
                $_SESSION['userId'] = $client_id;
                $_SESSION['LAST_ACTIVITY'] = time();
                header("location:client_index.php");
                exit();
              } else {
                //Display wrong password or username, IMPREVEDIBILE
                session_destroy();
                header("location:index.php?loginFailed=true");
                exit();
              }
            } else {
              //could not fetch
              $log_error = "store to file";
              session_destroy();
              header("location:index.php?loginError=true");
              exit();
            }
          } else {
            //No result with that username
            session_destroy();
            header("location:index.php?loginFailed=true");
            exit();
          }
        } else {
          //could not execute query
          $log_error = "store to file";
          session_destroy();
          header("location:index.php?loginError=true");
          exit();
        }

      } else {
        $log_error = "store to file";
        header("location:index.php?loginError=true");
        exit();
      }
      //close statement
      mysqli_stmt_close($stmt);
      //close connection
      mysqli_close($link);

    } else {

      $sql_req_a = "SELECT username, password, admin_id FROM admin WHERE username = ?";

      if($stmt = mysqli_prepare($link, $sql_req_a)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $user;
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          //check if username and password exist
          if(mysqli_stmt_num_rows($stmt) == 1){
            //Bind result variables
            mysqli_stmt_bind_result($stmt, $username, $hashed_password, $admin_id);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($pwd, $hashed_password)){
                //the pwd is correct, so start new session
                $_SESSION['admin'] = true;
                $_SESSION['loggedIn'] = true;
                $_SESSION['userId'] = $admin_id;
                $_SESSION['LAST_ACTIVITY'] = time();
                header("location:admin_index.php");
                exit();
              } else {
                //Display wrong password or username, IMPREVEDIBILE
                session_destroy();
                header("location:index.php?loginFailed=true");
                exit();
              }
            }
          } else {
            //No result with that username
            session_destroy();
            header("location:index.php?loginFailed=true");
            exit();
          }
        } else {
          //could not execute query
          $log_error = "store to file";
          session_destroy();
          header("location:index.php?loginError=true");
          exit();
        }

      } else {
        $log_error = "store to file";
        header("location:index.php?loginError=true");
        exit();
      }

      //close statement
      mysqli_stmt_close($stmt);
      //close connection
      mysqli_close($link);
    }

  } elseif($recaptcha === false){
    //recaptcha failed
    session_destroy();
    header("location:index.php?IORobot=true");
    $log_ids = "store to file";
    exit();

  } else {
    //incorrect input
    session_destroy();
    header("location:index.php?loginIncorrect=true");
    $log_ids = "store to file";
    exit();
  }
?>
