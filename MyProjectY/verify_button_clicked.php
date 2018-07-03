<?php
  require_once "connection_to_DB.php";
  define('Myheader', TRUE);
  define('mynav', TRUE);
  include "header.php";
  include "verify_auth.php";
  include "check_session.php";
  include_once "encrypt.php";

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

  if(!empty($_GET['clt'])){
    if(preg_match ('%^[0-9]{8}$%', stripslashes(trim($_GET['clt'])))){

      $account_num = escape_input($_GET['clt']);

    } else {

      $account_num = FALSE;

    }
  } else {

    $account_num = FALSE;

  }

  if($account_num == FALSE){
    header("location:admin_index.php?Error=true");
    exit();
  }

  if(preg_match ('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['admin_username'])))){

    $user = escape_input($_POST['admin_username']);

  } else {

    $user = FALSE;
    //echo error invalid

  }

  if(preg_match('%^[A-Za-z]{1}[A-Za-z0-9]{5,34}$%', stripslashes(trim($_POST['admin_password'])))){

    $pwd = escape_input($_POST['admin_password']);

  } else {

    $pwd = FALSE;
    //echo error invalid

  }

  if($user && $pwd && $recaptcha){

    if($user == "administrator"){

      $sql_req_a = "SELECT password FROM admin WHERE username = ?"; //change order for impredivibile
      $authenticated = false;
      if($stmt = mysqli_prepare($link, $sql_req_a)){
        //bind variables to be prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        //set parameters
        $param_username = $user;

        //Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          //Store result
          mysqli_stmt_store_result($stmt);

          //check if username and password exist
          if(mysqli_stmt_num_rows($stmt) == 1){
            //Bind result variables
            mysqli_stmt_bind_result($stmt, $hashed_password);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($pwd, $hashed_password)){
                //the pwd is correct, so start new session
                $authenticated = true;

              } else {
                //Display wrong password or username impredivibile
                $authenticated = false;
                session_destroy();
                header("location:index.php?loginFailed=true");
                exit();
              }
            } else {
              $log_error = "store to file";
              $authenticated = false;
              header("location:admin_index.php?Error=true");
              exit();
            }
          } else {
            //No result with that username
            $log_error = "store to file";
            $authenticated = false;
            session_destroy();
            header("location:index.php?loginFailed=true");
            exit();
          }
        } else {
          //could not execute query
          $log_error = "store to file";
          header("location:admin_manage_client.php?Error=true");
          exit();

        }
        //close statement

      } else {
        $log_error = "store to file";
        header("location:admin_manage_client.php?Error=true");
        exit();
      }
      mysqli_stmt_close($stmt);
      //close connection
      //mysqli_close($link);

      if($authenticated == true){
        $pri = encrypt("encrypt", $account_num);
        header("location:admin_del_client.php?clt=$pri");
        exit();
      } else {
        session_destroy();
        header("location:index.php?loginFailed=true");
        exit();
      }
    } else {

        session_destroy();
        header("location:index.php?loginIncorrect=true");
        $log = "store to file";
        exit();

    }

  } elseif($recaptcha === false){

      //recaptcha failed
      session_destroy();
      header("location:index.php?IORobot=true");
      $log_ids = "store to file";
      exit();

  }  else {

      session_destroy();
      header("location:index.php?loginIncorrect=true");
      $log = "store to file";
      exit();

  }

?>
