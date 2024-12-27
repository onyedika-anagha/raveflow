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

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'raveflow');

        // Register routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
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