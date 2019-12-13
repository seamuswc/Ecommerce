<?php

namespace App\Http\Controllers;

use App\product;
use App\shipments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {

  public function __construct() {
    parent::__construct();
    $this->middleware('auth');
  }

  public function goHome() {
    return redirect('/');
  }

  public function pending() {
    $pending = shipments::latest()->where('sent', 0)->get();
    return view('admin.pendingShipments', compact('pending'));
  }

  public function shipped() {
    $sent = shipments::latest()->where('sent', 1)->get();
    return view('admin.sentShipments', compact('sent'));
  }

  public function manage() {
    $products = product::all();
    return view('admin.manageProduct', compact('products'));
  }

  public function create(Request $request) {

    ini_set('max_execution_time', 300);

    $validate_data = $request->validate([
      'name' => 'required|min:2',
      'price' => 'required|integer',
      'stock' => 'required',
      'photo' => 'required|file|image|max:5000|mimes:jpeg,png',
    ]);

    $product = product::first();

    if ($product !== null) {

      self::productDelete($product->id);
    }

    $new = new product;
    $name = $new->createProduct($request);

    return back();
  }

  public function delete() {
    $id = request()->input('delete');
    $new = new shipments;
    $new->destroy($id);
    return back();
  }

  public function productDelete($id) {
    //$id = request()->input('delete');

    $product = product::findOrFail($id);

    Storage::disk('public')->delete($product->photo);

    $product->delete();

    return back();
  }

  public function sent($id) {
    $new = new shipments;
    $new->sent($id);
    return back();
  }

  public function stock(request $request) {

    $id = request()->input('id');
    $stock = request()->input('stock');
    if ($stock == NULL) {
      return back();
    }
    $new = new product;
    $new->adjust_stock($id, $stock);
    return back();
  }

}
