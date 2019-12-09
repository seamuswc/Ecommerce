<?php

namespace App\Http\Controllers;

use App\country;
use Illuminate\Http\Request;

class CountryController extends Controller {

  public function store(Request $request) {

    session()->flash("settingsTab", "country");

    $validatedData = $request->validate([
      'country' => 'required',
      'callingCode' => 'required',
      'import_tariff' => 'required',
      'sales_tax' => 'required',
      'shipping' => 'required',
    ]);

    $country = explode("|", $request->input('country'));

    country::create([
      'name' => $country[1],
      'iso' => $country[0],
      'calling_code' => '+' . $request->input('callingCode'),
      'import_tariff' => $request->input('import_tariff'),
      'sales_tax' => $request->input('sales_tax'),
      'shipping' => $request->input('shipping'),
    ]);

    session()->flash("notification", [
      'message' => $country[1] . " " . __('translations.notifications.added'),
      'type' => 'success',
    ]);

    return redirect('settings');
  }

  public function delete(Request $request, $id) {
    
    session()->flash("settingsTab", "country");

    $country = country::findOrFail($id);

    $countryName = $country->name;

    $country->delete();

    session()->flash("notification", [
      'message' => $countryName . " " . __('translations.notifications.deleted'),
      'type' => 'error',
    ]);

    return redirect('settings');
  }

  public function getSupported() {
    return country::orderBy('name', 'asc')->get();
  }
}
