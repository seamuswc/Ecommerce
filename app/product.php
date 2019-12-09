<?php

namespace App;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class product extends Model {

  public function minus_stock($id, $quantity) {
    
    $product = product::find($id);
    $product->stock = $product->stock - (int) $quantity;
    $product->save();
  }

  public function adjust_stock($id, $stock) {
    
    $product = product::find($id);
    $product->stock = $stock;
    $product->save();
  }

  public function ordered($id, $quantity) {
    $product = product::find($id);
    $product->orders = $product->orders + (int) $quantity;
    $product->save();
  }

  public function createProduct(Request $request) {

    $file = request('photo');

    $photo = '';

    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

      $extension = $file->extension();
      $name = sha1(time() . time()) . ".{$extension}";
      $photo = $name;
      $file->storeAs('public', $name);
    } else {
      return 'error';
    }

    product::create([
      'name' => request('name'),
      'photo' => $photo,
      'price' => request('price'),
      'stock' => request('stock'),
      'orders' => 0,
    ]);

    return request('name');
  }

  protected $fillable = ['name', 'photo', 'price', 'stock', 'orders'];
}
