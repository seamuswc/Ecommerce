<?php

namespace App;
use Illuminate\Http\Request;

class blockcypher {

  protected $rate, $address, $product, $request;

  function __construct($rate, $address, Request $request, product $product) {
    
    $this->rate = $rate;
    
    $this->address = $address;
    
    $this->product = $product;
    
    $this->request = $request;
  }

  public function checkIfRecieved() {

    for ($i = 0; $i < 8; $i++) {
      
      sleep(2);

      if (@$json = file_get_contents("https://api.blockcypher.com/v1/btc/main/addrs/$this->address")) { //use api instead of electrum ssh to free up electrum ssh sessions
        $json = json_decode($json);
      } else {
        return 'badaddress';
      }

      $received = (float) ($json->unconfirmed_balance + $json->balance) * 0.00000001; //changes it from satoshis to rate units

      if ($received >= $this->rate) {

        return true;

      } else {

        return $received;

      }

    } //end for
  }

}

/*
