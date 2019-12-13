<?php

namespace App\Http\Controllers;

use App\country;
use App\settings;
use App\cryptocurrency;
use Illuminate\Http\Request;

class SettingsController extends Controller {

  public function __construct() {
    parent::__construct();
    $this->middleware('auth');
  }

  public function index() {

    $exchangeRates = cryptocurrency::getRates();

    $all_settings = settings::getAll();

    $countries = country::getList();

    $supportedCountries = country::orderBy('name', 'asc')->get();

    asort($countries);

    return view('admin.settings', compact('exchangeRates', 'all_settings', 'countries', 'supportedCountries'));
  }

  public function updateBasicInfo(Request $request) {
    
    $validate_data = $request->validate([
      'site_name' => 'required',
      'gemini_key' => 'required',
      'gemini_secret' => 'required'
    ]);

    $data = [
      'site_name' => $request->input('site_name'),
      'key' => encrypt($request->input('geminiKey')),
      'secret' => encrypt($request->input('geminiSecret')),
    ];

    settings::updateSettings('basic_info', $data);

    session()->flash("notification", [
      'message' => __('translations.labels.site_name') . " " . __('translations.notifications.updated'),
      'type' => 'info',
    ]);

    return redirect('settings');
  }
}
