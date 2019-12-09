<?php

namespace App;

use DB;
use App\product;
use App\carrier;
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
      'carrier_id' => 0
    ]);

    $new = new product;

    $new->minus_stock($shipping['product']->id, $shipping['qty']); //Add a queqe to prevent over orders

    $new->ordered($shipping['product']->id, $shipping['qty']); //Add a queqe to prevent over orders

    if ($phone !== null) {
      //notify users via text message
      try {
        $shipment->notify(new ShipmentUpdate('created', $shipment));
      } catch (\Exception $e) {
        Log::error($e->getMessage());
      }
    }

    return $order_number;
  }

  public function sent($id) {

    $trackingNumber = request('trackingNumber');

    $carrier = carrier::findOrFail(request('carrierId'));

    $shipment = shipments::find($id);
    $shipment->sent = 1;
    $shipment->tracking_number = $trackingNumber;
    $shipment->carrier_id = request('carrierId');
    $shipment->date = Carbon::now();
    $shipment->save();

    //dd($shipment->phone);
    
    if ($shipment->phone !== null) {
      try {
        $shipment->notify(new ShipmentUpdate('sent', $shipment, $trackingNumber, $carrier->name));
      } catch (\Exception $e) {
        Log::error($e->getMessage());
      }
    }
    
  }

  /**
   * Route notifications for the Nexmo channel.
   *
   * @param  \Illuminate\Notifications\Notification  $notification
   * @return string
   */
  public function routeNotificationForNexmo($notification) {
    return $this->formatPhoneNumber($this->phone);
  }

  /**
   * Removes + and space in phone number
   *
   * @param $phone_number
   * @return String
   */
  private function formatPhoneNumber($phone_number) {
    //strip +
    $phone_number = str_replace("+", "", $phone_number);

    //strip -
    $phone_number = str_replace("-", "", $phone_number);

    if ($phone_number == trim($phone_number) && strpos($phone_number, ' ') !== false) {

      $exploded = explode(' ', $phone_number);

      return $exploded[0] . $exploded[1];
    }

    return $phone_number;
  }

  public function carrier() {
    return $this->belongsTo('App\carrier');
  }

  protected $fillable = ['order_number', 'name', 'country', 'city', 'postal', 'address1', 'address2', 'phone', 'sent', 'tracking_number', 'carrier_id', 'date', 'state','qty'];

}
