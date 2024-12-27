<?php

namespace OnyedikaAnagha\RaveFlow;

use Illuminate\Support\ServiceProvider;

class RaveFlowServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../config/flutterwave.php' => config_path('flutterwave.php'),
        ], 'config');

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/flutterwave.php', 'flutterwave'
        );

        $this->app->singleton('raveflow', function ($app) {
            return new RaveFlow();
        });
    }
}