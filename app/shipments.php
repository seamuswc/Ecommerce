<?php

namespace App;

use DB;
use App\product;
use Carbon\Carbon;
use App\orderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\ShipmentUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class shipments extends Model {

  use Notifiable;

  public function createShipment($shipping) {

    $order_number = strtoupper(create_unique_id(6));

    $phone = ($shipping['phone'] !== null) ? $shipping['calling_code'] . ' ' . $shipping['phone'] : null;

    $shipment = self::create([
      'order_number' => $order_number,
      'name' => $shipping['name'],
      'country' => $shipping['country'],
      'city' => $shipping['city'],
      'postal' => $shipping['postal'],
      'address1' => $shipping['address1'],
      'address2' => $shipping['address2'],
      'phone' => $phone,
      'qty' => $shipping['qty'],
      'sent' => 0,
      'date' => null,
      'state' => $shipping['state'],
      'tracking_number' => 0,
    ]);

    $new = new product;

    $new->minus_stock($shipping['product']->id, $shipping['qty']); //Add a queqe to prevent over orders

    $new->ordered($shipping['product']->id, $shipping['qty']); //Add a queqe to prevent over orders

    return $order_number;
  }

  public function sent($id) {

    $trackingNumber = request('trackingNumber');
    $shipment = shipments::find($id);
    $shipment->sent = 1;
    $shipment->tracking_number = $trackingNumber;
    $shipment->date = Carbon::now();
    $shipment->save();
    
  }

  protected $fillable = ['order_number', 'name', 'country', 'city', 'postal', 'address1', 'address2', 'phone', 'sent', 'tracking_number', 'date', 'state','qty'];

}
