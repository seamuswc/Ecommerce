<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class settings extends Model {
    
  protected $fillable = ['key', 'value'];

  protected $casts = [
    'value' => 'json',
  ];

  public function scopeGetAll() {
    return settings::all()->keyBy('key');
  }

  public function scopeGetSetting($query, $key) {
    $setting = $query->where('key', $key)->first();

    if ($setting != null) {
      return $setting->value;
    }

    return false;
  }

  public function scopeUpdateSettings($query, $key, $data) {
    $setting = $query->where('key', $key)->first();

    if ($setting != null) {

      $setting->value = $data;

      $setting->save();
    } else {

      self::create([
        'key' => $key,
        'value' => $data,
      ]);
    }
  }
}
