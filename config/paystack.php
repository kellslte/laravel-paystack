<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Paystack Secret Key
    |--------------------------------------------------------------------------
    |
    | Your Paystack secret key. You can get this from your Paystack dashboard.
    | Use test key for development and live key for production.
    |
    */

    'secret_key' => env('PAYSTACK_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Paystack Public Key
    |--------------------------------------------------------------------------
    |
    | Your Paystack public key. This is used for client-side operations.
    |
    */

    'public_key' => env('PAYSTACK_PUBLIC_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Paystack Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for Paystack API. Default is the production URL.
    | For testing, you can use: https://api.paystack.co
    |
    */

    'base_url' => env('PAYSTACK_BASE_URL', 'https://api.paystack.co'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout in seconds for HTTP requests to Paystack API.
    |
    */

    'timeout' => env('PAYSTACK_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | HTTP Retry Attempts
    |--------------------------------------------------------------------------
    |
    | Number of times to retry failed HTTP requests.
    |
    */

    'retry_attempts' => env('PAYSTACK_RETRY_ATTEMPTS', 3),

    /*
    |--------------------------------------------------------------------------
    | Webhook Secret
    |--------------------------------------------------------------------------
    |
    | Your webhook secret for verifying webhook signatures.
    | You can get this from your Paystack dashboard under Settings > Webhooks.
    |
    */

    'webhook_secret' => env('PAYSTACK_WEBHOOK_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Webhook Route Prefix
    |--------------------------------------------------------------------------
    |
    | The route prefix for webhook endpoints.
    |
    */

    'webhook_prefix' => env('PAYSTACK_WEBHOOK_PREFIX', 'paystack'),

    /*
    |--------------------------------------------------------------------------
    | Enable Logging
    |--------------------------------------------------------------------------
    |
    | Whether to log HTTP requests and responses to Paystack API.
    |
    */

    'enable_logging' => env('PAYSTACK_ENABLE_LOGGING', false),
];
