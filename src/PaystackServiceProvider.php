<?php

namespace Scwar\LaravelPaystack;

use Illuminate\Support\ServiceProvider;
use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Http\Clients\GuzzleClient;

class PaystackServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/paystack.php',
            'paystack'
        );

        // Register HTTP Client
        $this->app->singleton(HttpClientInterface::class, function ($app) {
            return new GuzzleClient(
                config('paystack.secret_key'),
                config('paystack.base_url'),
                config('paystack.timeout', 30),
                config('paystack.retry_attempts', 3),
                config('paystack.enable_logging', false)
            );
        });

        // Register Paystack Manager
        $this->app->singleton(Paystack::class, function ($app) {
            return new Paystack($app->make(HttpClientInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish config file
        $this->publishes([
            __DIR__ . '/../config/paystack.php' => config_path('paystack.php'),
        ], 'paystack-config');

        // Load webhook routes if enabled
        if (config('paystack.webhook_secret')) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/webhooks.php');
        }
    }
}
