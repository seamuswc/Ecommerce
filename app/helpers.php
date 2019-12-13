<?php

/**
 * Show notification based on session
 *
 * @param String $message
 * @param String $type
 * @return void
 */
if (!function_exists('show_notification')) {

  function show_notification($message, $type = 'error') {

    //types option are error, success, info, warning
    $notif = view('layouts.notification')->with([
      'message' => $message,
      'type' => $type,
    ])->render();

    echo $notif;
  }
}

/**
 * Get the calling code from this format +30|country
 *
 * @param String $calling_code
 * @return String
 */
if (!function_exists('format_calling_code')) {

  function format_calling_code($calling_code) {

    if (strpos($calling_code, '|')) {

      $calling_code = explode('|', $calling_code);

      return str_replace("+", "", $calling_code[0]);
    }

    return str_replace("+", "", $calling_code);
  }
}

/**
 * Generates a unique id
 *
 * @param $length
 * @return string
 */
if (!function_exists('create_unique_id')) {
  
  function create_unique_id($length) 
  {
      $token = "";
      $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
      $codeAlphabet.= "0123456789";
      $max = strlen($codeAlphabet); // edited
      for ($i=0; $i < $length; $i++) {
          $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
      }
      return $token.uniqid();
  }
}

/**
 * Generates random number
 *
 * @param $min
 * @param $max
 * @return int
 */
if (!function_exists('crypto_rand_secure')) {
 
  function crypto_rand_secure($min, $max)
  {
      $range = $max - $min;
      if ($range < 1) return $min; // not so random...
      $log = ceil(log($range, 2));
      $bytes = (int) ($log / 8) + 1; // length in bytes
      $bits = (int) $log + 1; // length in bits
      $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
      do {
          $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
          $rnd = $rnd & $filter; // discard irrelevant bits
      } while ($rnd > $range);
      return $min + $rnd;
  }
}