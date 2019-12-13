<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model {

  protected $fillable = ['name', 'iso', 'calling_code','shipping'];

  // get the available country list from config minus the supported country
  public function scopeGetList($query) {
    
    $supported = $query->orderBy('name', 'asc')->get();

    $countries = config('dropdowns.countries');

    if ($supported->count()) {

      // convert laravel collection into key value pairs
      $keyed = $supported->mapWithKeys(function ($item) {
        return [$item['iso'] => $item['name']];
      });

      $supported = $keyed->all();

      //remove supported countries from the list
      $countries = array_diff($countries, $supported);
    }

    return $countries;
  }

  //Gets an array of countries with their code
  public function scopeGetCountryCodes($query) {
    
    $supported = $query->orderBy('name', 'asc')->get();

    if ($supported->count()) {

      $keyed = $supported->mapWithKeys(function ($item) {
        return [$item['name'] => $item['calling_code']];
      });

      return $keyed->all();
    }

    return ['United States' => '+1'];
  }

}
