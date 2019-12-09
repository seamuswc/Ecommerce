<?php

namespace App\Observers;

use App\product;

class ProductObserver {
  /**
   * Handle to the product "created" event.
   *
   * @param  \App\product  $product
   * @return void
   */
  public function created(product $product) {
    session()->flash("notification", [
      'message' => "$product->name " . __('translations.notifications.created'),
      'type' => 'info',
    ]);
  }

  /**
   * Handle the product "updated" event.
   *
   * @param  \App\product  $product
   * @return void
   */
  public function updated(product $product) {
    session()->flash("notification", [
      'message' => "$product->name " . __('translations.notifications.updated'),
      'type' => 'success',
    ]);
  }

  /**
   * Handle the product "deleted" event.
   *
   * @param  \App\product  $product
   * @return void
   */
  public function deleted(product $product) {
    session()->flash("notification", [
      'message' => "$product->name " . __('translations.notifications.deleted'),
      'type' => 'error',
    ]);
  }
}
