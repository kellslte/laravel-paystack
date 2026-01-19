<?php

use Illuminate\Support\Facades\Route;
use Scwar\LaravelPaystack\Webhooks\WebhookController;
use Scwar\LaravelPaystack\Webhooks\WebhookMiddleware;

$prefix = config('paystack.webhook_prefix', 'paystack');

Route::prefix($prefix)
    ->middleware([WebhookMiddleware::class])
    ->post('/webhook', [WebhookController::class, 'handle'])
    ->name('paystack.webhook');
