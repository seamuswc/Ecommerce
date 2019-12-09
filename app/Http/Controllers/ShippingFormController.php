<?php

namespace App\Http\Controllers;

use App\gemini;
use App\product;
use App\settings;
use App\cryptocurrency;
use App\Http\Requests\ShippingV;

class ShippingFormController extends Controller {

  protected $gemini;

  public function __construct() {

    parent::__construct();

    //get gemini settings
    $this->gemini = settings::getSetting('gemini');
  }

  /*
  1) Validates Form
  2) Makes it show paid is flase so payment cannot be duplicated
  3) Sets form data into a session for future use
  4) Make a gemini request
   */
  public function validateShippingForm(ShippingV $request) {

    //1
    $request->validated();

    //2
    session([
      'paid' => ['paid' => false],
    ]);

    //3
    $product = session('product');
    $result_explode = explode('|', $request->input('country'));
    $shipping_rate = (float) $result_explode[2];
    $country = $result_explode[3];

    $result_explode = explode('|', $request->input('callingCode'));
    $calling_code = $result_explode[0];

    $crypto_rate = session('crypto_rate');

    $qty = $request->input('qty');

    $total = (int) $qty * $product->price;

    $total_in_crypto = number_format($total / (float) $crypto_rate['crypto_rate'], 8);

    //add to session data
    session([
      'shipping' => [
        'name' => $request->input('name'),
        'country' => $country,
        'city' => $request->input('city'),
        'postal' => $request->input('postal'),
        'address1' => $request->input('address1'),
        'address2' => $request->input('address2'),
        'state' => $request->input('state'),
        'calling_code' => $calling_code,
        'phone' => $request->input('phone'),
        'qty' => $qty,
        'total' => [
          'local' => $total,
          'crypto' => cryptocurrency::removeTrailingZeros($total_in_crypto),
        ],
        'product' => $product,
      ],
    ]);

    $shipping = session('shipping');

    //4
    if ($this->gemini) {
      // set gemini credentials and decrypt them
      $key = decrypt($this->gemini['key']);
      $secret = decrypt($this->gemini['secret']);
    } else {
      session()->flash("notification", [
        'message' => __('translations.notifications.gemini_no_key'),
        'type' => 'error',
      ]);

      return back()->withInput();
    }

    if (!$new = new Gemini($key, $secret)) {
      session()->flash("notification", [
        'message' => __('translations.notifications.internet_error'),
        'type' => 'error',
      ]);

      return back()->withInput();
    }

    $address = $new->createAddress();

    if ($address === false) { //checks if error was sent back
      session()->flash("notification", [
        'message' => __('translations.notifications.crypto_down', ['tickerSymbol' => cryptocurrency::$ticker_symbol]),
        'type' => 'error',
      ]);

      return back()->withInput();
    }

    return view('storefront.payment', compact('address', 'shipping'));
  }
}
