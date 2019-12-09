<?php

namespace App;

class bitaps {

  protected $rate, $address;

  function __construct($rate, $address) {
    
    $this->rate = $rate;
    
    $this->address = $address;
  }

  public function checkIfRecieved() {
    
    for ($i = 0; $i < 8; $i++) {
      
      sleep(2);

      try {
        $json = file_get_contents("https://api.bitaps.com/btc/v1/blockchain/address/state/$this->address"); //use api instead of electrum ssh to free up electrum ssh sessions
      } catch (Exception $e) {
        return false;
      }
      
      $json = json_decode($json);

      $received = (float) ($json->data->pendingReceivedAmount + $json->data->balance) * 0.00000001; //changes it from satoshis to rate units

      if ($received >= $this->rate) {

        return true;

      } else {

        return $received;

      }
    } //end for
  }

}

/*
