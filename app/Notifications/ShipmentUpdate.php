<?php

namespace App\Notifications;

use App;
use App\country;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;

class ShipmentUpdate extends Notification implements ShouldQueue {

  use Queueable;

  protected $status;

  protected $shipment;

  protected $trackingNumber;

  protected $carrier;

  /**
   *
   * @param String $status - can be 'sent' or 'created'
   * @param App\shipments $shipment
   * @param String $trackingNumber
   * @param String $carrier
   * @return void
   */
  public function __construct($status, $shipment, $trackingNumber = null, $carrier = null) {
    $this->status = $status;

    $this->shipment = $shipment;

    $this->trackingNumber = $trackingNumber;

    $this->carrier = $carrier;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable) {
    return ['nexmo'];
  }

  /**
   * Handles SMS sending
   *
   * @param mixed  $notifiable
   * @return Illuminate\Notifications\Messages\NexmoMessage
   */
  public function toNexmo($notifiable) {

    $message = '';
    // Check if created or sent
    if ($this->status === 'created') {

      $message = __('translations.sms.shippingCreated', ['productName' => $this->shipment->order_number]);
    } else if ($this->status === 'sent') {
      $message = __('translations.sms.shippingSent', ['productName' => $this->shipment->order_number, 'trackingNumber' => $this->trackingNumber, 'carrier' => $this->carrier]);
    }

    $nexmoMessage = new NexmoMessage;

    return $nexmoMessage->content($message);
  }
}
