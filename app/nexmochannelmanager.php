<?php

namespace App;

use App\settings;
use Illuminate\Notifications\ChannelManager;
use Nexmo\Client as NexmoClient;
use Nexmo\Client\Credentials\Basic as NexmoCredentials;
use \Illuminate\Notifications\Channels\NexmoSmsChannel;

class NexmoChannelManager extends ChannelManager {
  //overidde nexmo default driver
  protected function createNexmoDriver() {
    
    $nexmo = settings::getSetting('nexmo');

    $key = $this->app['config']['services.nexmo.key'];

    $secret = $this->app['config']['services.nexmo.secret'];

    $smsFrom = $this->app['config']['services.nexmo.sms_from'];

    if ($nexmo) {

      $key = decrypt($nexmo['key']);

      $secret = decrypt($nexmo['secret']);

      $smsFrom = $nexmo['sms_from'];

    }

    return new NexmoSmsChannel(new NexmoClient(new NexmoCredentials($key, $secret)), $smsFrom);
  }
}