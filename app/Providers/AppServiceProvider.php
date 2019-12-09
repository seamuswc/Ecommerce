<?php

namespace App\Providers;

use App\product;
use App\shipments;
use App\Observers\ProductObserver;
use App\Observers\ShipmentsObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        product::observe(ProductObserver::class);

        shipments::observe(ShipmentsObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
    }
}
