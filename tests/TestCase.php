<?php

namespace Scwar\LaravelPaystack\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Scwar\LaravelPaystack\PaystackServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('paystack.secret_key', 'sk_test_1234567890');
        $this->app['config']->set('paystack.public_key', 'pk_test_1234567890');
        $this->app['config']->set('paystack.base_url', 'https://api.paystack.co');
    }

    protected function getPackageProviders($app): array
    {
        return [
            PaystackServiceProvider::class,
        ];
    }
}
