<?php

namespace App;

use App\bitaps;

class cryptocurrency {
  /**
   * Defines what symbol to show ex: BTC or LTC
   */
  public static $ticker_symbol = "BTC";

  /**
   * Defines the crypto currency type ex: Bitcoin or Litecoin
   */
  public static $ticker = "Bitcoin";

  /**
   * Generates url to check crypto wallet
   * Replace $api_url for desired wallet checker
   *
   * @param String $address
   * @return String
   */
  public static function checkWallet($address) {
    $api_url = "https://btc.bitaps.com/";

    return $api_url . $address;
  }

  /**
   * Get list of currency rates from coinbase
   *
   * @return mixed
   */
  public static function getRates() {
    $data = file_get_contents('https://api.coinbase.com/v2/exchange-rates?currency=USD');

    if ($data) {
      $rates = json_decode($data, true);

      return $rates['data']['rates'];
    }

    return false;
  }

  /**
   * Get Cryptocurrency rate
   * Replace $api_url for rate checker
   *
   * @param String $currency
   * @return mixed
   */
  public static function getRate($currency = 'USD') {
    $api_url = "https://api.coinbase.com/v2/prices/spot?currency=";

    try {

      $data = file_get_contents($api_url . $currency);

      if ($data) {

        $price = json_decode($data, true);

        return $price['data']['amount'];
      }
    } catch (\Exception $e) {

      return false;
    }
  }

  /**
   * Check if payment is received
   * Replace $checker with desired api for checking received payment
   *
   * @param String $rate
   * @param String $address
   * @return Boolean
   */
  public static function checkIfReceived($rate, $address) {
    $checker = new bitaps($rate, $address);

    return $checker->checkIfRecieved();
  }

  /**
   * Removes trailing zeros from a number
   *
   * @param $number
   * @return
   */
  public static function removeTrailingZeros($number) {
    return preg_replace('/(\.{1}0+)$|(?<=\d)0+$/', '', (string) $number);
  }
}
