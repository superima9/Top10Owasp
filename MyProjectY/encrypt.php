<?php
  function encrypt($direction, $input){

    $output = false;
    $secret_iv = '2y3xdfw';
    $secret_key = "hc23uy0ee9c0nrx0fffn0x292m09xl";

    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if($direction == 'encrypt'){
      $output = openssl_encrypt($input, "AES-256-CBC", $secret_key, 0, $iv);
      $output = base64_encode($output);
    } elseif($direction == 'decrypt'){
      $output = openssl_decrypt(base64_decode($input), "AES-256-CBC", $secret_key, 0, $iv);
    } else {
      $output = false;
    }
      return $output;
  }


?>
