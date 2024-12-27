<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Flutterwave Keys
    |--------------------------------------------------------------------------
    */
    'public_key' => env('FLW_PUBLIC_KEY'),
    'secret_key' => env('FLW_SECRET_KEY'),
    'encryption_key' => env('FLW_ENCRYPTION_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    */
    
    'is_production' => env('FLW_PRODUCTION', false),

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    */
    'currency' => env('FLW_CURRENCY', 'NGN'),

    /*
    |--------------------------------------------------------------------------
    | Webhook Settings
    |--------------------------------------------------------------------------
    */
    'webhook_secret' => env('FLW_WEBHOOK_SECRET'),
    'webhook_url' => env('FLW_WEBHOOK_URL'),
];