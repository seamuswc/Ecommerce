<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(\Illuminate\Notifications\ChannelManager::class, function($app){
            return new \App\NexmoChannelManager($app);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
