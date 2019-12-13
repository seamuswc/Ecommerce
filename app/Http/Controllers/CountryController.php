<?php

namespace App\Http\Controllers;

use App\country;
use Illuminate\Http\Request;

class CountryController extends Controller {

  public function store(Request $request) {

    $validate_data = $request->validate([
      'country' => 'required',
      'calling_code' => 'required',
      'shipping' => 'required',
    ]);

    $country = explode("|", $request->input('country'));

    country::create([
      'name' => $country[1],
      'iso' => $country[0],
      'calling_code' => '+' . $request->input('calling_code'),
      'shipping' => $request->input('shipping'),
    ]);

    session()->flash("notification", [
      'message' => $country[1] . " " . __('translations.notifications.added'),
      'type' => 'success',
    ]);

    return redirect('settings');
  }

  public function delete(Request $request, $id) {
    
    $country = country::findOrFail($id);

    $country_name = $country->name;

    $country->delete();

    session()->flash("notification", [
      'message' => $country_name . " " . __('translations.notifications.deleted'),
      'type' => 'error',
    ]);

    return redirect('settings');
  }

  public function getSupported() {
    return country::orderBy('name', 'asc')->get();
  }
}
