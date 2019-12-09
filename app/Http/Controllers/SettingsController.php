<?php

namespace App\Http\Controllers;

use App\carrier;
use App\country;
use App\settings;
use App\cryptocurrency;
use Illuminate\Http\Request;

class SettingsController extends Controller {

/* set this array if you want a text message sent to your phone
notifying you when your exchange keys were changed */
  protected $catchbaddy = array(
    "catch" => false, //set to true to activate
    "kpublic" => "NULL", //nexmo.com public key
    "kprivate" => "NULL", //nexmo.com private key
    "to" => NULL, //your phone number "include country calling code but no symbols(+) or spaces"
    "from" => NULL, //nexmo.com from number
  );

  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {

    $exchangeRates = cryptocurrency::getRates();

    $settings = settings::getAll();

    $countries = country::getList();

    $carriers = carrier::all();

    $supportedCountries = country::orderBy('name', 'asc')->get();

    asort($countries);

    return view('admin.settings', compact('exchangeRates', 'settings', 'countries', 'supportedCountries', 'carriers'));
  }

  public function updateBasicInfo(Request $request) {

    session()->flash("settingsTab", "basicInfo");

    $validatedData = $request->validate([
      'redditUrl' => 'required',
      'currency' => 'required',
    ]);

    $data = [
      'redditUrl' => $request->input('redditUrl'),
      'currency' => $request->input('currency'),
    ];

    settings::updateSettings('basic_info', $data);

    session()->flash("notification", [
      'message' => __('translations.headings.settings') . " " . __('translations.notifications.updated'),
      'type' => 'info',
    ]);

    return redirect('settings');
  }

  public function updateNexmoKeys(Request $request) {
    session()->flash("settingsTab", "apiKeys");

    $validatedData = $request->validate([
      'nexmoKey' => 'required',
      'nexmoSecret' => 'required',
      'smsFrom' => 'required',
    ]);

    $data = [
      'key' => encrypt($request->input('nexmoKey')),
      'secret' => encrypt($request->input('nexmoSecret')),
      'sms_from' => $request->input('smsFrom'),
    ];

    settings::updateSettings('nexmo', $data);

    session()->flash("notification", [
      'message' => __('translations.headings.nexmo') . " " . __('translations.notifications.updated'),
      'type' => 'info',
    ]);

    return redirect('settings');
  }

  public function updateGeminiKeys(Request $request) {
    session()->flash("settingsTab", "apiKeys");

    $validatedData = $request->validate([
      'geminiKey' => 'required',
      'geminiSecret' => 'required',
    ]);

    $data = [
      'key' => encrypt($request->input('geminiKey')),
      'secret' => encrypt($request->input('geminiSecret')),
    ];

    settings::updateSettings('gemini', $data);

    if ($this->catchbaddy['catch'] == true) {
      $this->catchBaddy();
    }

    session()->flash("notification", [
      'message' => __('translations.headings.gemini') . " " . __('translations.notifications.updated'),
      'type' => 'info',
    ]);

    return redirect('settings');
  }

  protected function catchBaddy() {
    
    $basic = new \Nexmo\Client\Credentials\Basic($this->catchbaddy['kpublic'], $this->catchbaddy['kprivate']);
    $client = new \Nexmo\Client($basic);

    $message = $client->message()->send([
      'to' => $this->catchbaddy['to'],
      'from' => $this->catchbaddy['from'],
      'text' => 'Exchange Changed',
    ]);
    $response = $message->getResponseData();
  }

}
