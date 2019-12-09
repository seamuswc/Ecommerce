<?php

namespace App\Http\Controllers;

use App\carrier;
use Illuminate\Http\Request;

class CarrierController extends Controller {

  public function store(Request $request) {

    session()->flash("settingsTab", "carrier");

    $validatedData = $request->validate([
      'carrier' => 'required',
    ]);

    $country = explode("|", $request->input('country'));

    carrier::create([
      'name' => $request->input('carrier'),
    ]);

    session()->flash("notification", [
      'message' => $request->input('carrier') . " " . __('translations.notifications.added'),
      'type' => 'success',
    ]);

    return redirect('settings');
  }

  public function delete(Request $request, $id) {
    
    session()->flash("settingsTab", "carrier");

    $carrier = carrier::findOrFail($id);

    $carrier->delete();

    session()->flash("notification", [
      'message' => $carrier->name . " " . __('translations.notifications.deleted'),
      'type' => 'error',
    ]);

    return redirect('settings');
  }
}
