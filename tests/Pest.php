<?php

use Orchestra\Testbench\TestCase;
use Scwar\LaravelPaystack\PaystackServiceProvider;

uses(TestCase::class)->in(__DIR__);

function getPackageProviders($app)
{
    return [
        PaystackServiceProvider::class,
    ];
}
