<?php

namespace App;

use App\shipments;

class success_denied {

  protected $rate = 0;
  protected $address, $request;

  function __construct($rate, $address) {
    $this->rate = (float) $rate;
    $this->address = $address;
  }

  public function success() {

    if (session('paid')['paid']) {
      return redirect('payment/confirmed');
    }

    $shipping = session('shipping');

    $new = new shipments;

    $order_number = $new->createShipment($shipping);

    session([
      'confirmed' => [
        'country' => $shipping['country'],
        'city' => $shipping['city'],
        'order_number' => $order_number,
        'rate' => $this->rate,
        'product' => $shipping['product'],
        'qty' => $shipping['qty'],
        'total' => $shipping['total'],
      ],
      'paid' => ['paid' => true],
    ]);

    return redirect('payment/confirmed');
  }

  public function denied($recieved) {

    $owed = $this->rate - $recieved;

    $shipping = session('shipping');

    $address = $this->address;

    return view('storefront.owed', compact('address', 'shipping', 'owed'));
  }
}
