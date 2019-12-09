<?php

namespace App\Observers;

use App\shipments;

class ShipmentsObserver {
  
  /**
   * Handle the product "updated" event.
   *
   * @param  \App\shipments  $shipment
   * @return void
   */
  public function updated(shipments $shipment) {
    $old = $shipment->getOriginal();

    //check if shipment is sent
    if ($shipment->sent == '1' && $old['sent'] == '0') {

      session()->flash("notification", [
        'message' => __('translations.notifications.shipmentSent'),
        'type' => 'success',
      ]);
    }

  }

  /**
   * Handle the product "deleted" event.
   *
   * @param  \App\shipments  $shipment
   * @return void
   */
  public function deleted(shipments $shipment) {
    session()->flash("notification", [
      'message' => "$shipment->order_number " . __('translations.notifications.deleted'),
      'type' => 'error',
    ]);
  }
}
