<?php

namespace App\Http\Controllers;

use App\product;
use App\cryptocurrency;
use App\success_denied;
use Illuminate\Http\Request;

class PaymentController extends Controller {

  public function check(Request $request, product $product) {

    $rate = $request->input('rate');

    $address = $request->input('address');

    $payment_received = cryptocurrency::checkIfReceived($rate, $address);

    $success_denied = new success_denied($rate, $address, $request);

    if ($payment_received === false) {

      session()->flash("notification", [
        'message' => __('translations.notifications.bad_address'),
        'type' => 'error',
      ]);

      session()->flash("address", $address);
      return back();
    }

    if ($payment_received === true) {
      return $success_denied->success();
    }

    return $success_denied->denied($payment_received);
  }

  public function confirmed() {

    if (session('confirmed') && session('paid')['paid'] === true) {

      $confirmed = session('confirmed');

      session()->forget('confirmed', 'shipping','product');

      return view('storefront.confirmed', compact('confirmed'));
    }

    return redirect('/');
  }
}
