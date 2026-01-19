<?php

namespace Scwar\LaravelPaystack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Scwar\LaravelPaystack\Resources\Transaction transaction()
 * @method static \Scwar\LaravelPaystack\Resources\Customer customer()
 * @method static \Scwar\LaravelPaystack\Resources\Subscription subscription()
 * @method static \Scwar\LaravelPaystack\Resources\Plan plan()
 * @method static \Scwar\LaravelPaystack\Resources\Product product()
 * @method static \Scwar\LaravelPaystack\Resources\Subaccount subaccount()
 * @method static \Scwar\LaravelPaystack\Resources\Split split()
 * @method static \Scwar\LaravelPaystack\Resources\VirtualAccount virtualAccount()
 * @method static \Scwar\LaravelPaystack\Resources\Transfer transfer()
 * @method static \Scwar\LaravelPaystack\Resources\TransferRecipient transferRecipient()
 * @method static \Scwar\LaravelPaystack\Resources\ApplePay applePay()
 * @method static \Scwar\LaravelPaystack\Resources\Dispute dispute()
 * @method static \Scwar\LaravelPaystack\Resources\Refund refund()
 * @method static \Scwar\LaravelPaystack\Resources\Verification verification()
 * @method static \Scwar\LaravelPaystack\Resources\Miscellaneous miscellaneous()
 *
 * @see \Scwar\LaravelPaystack\Paystack
 */
class Paystack extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return \Scwar\LaravelPaystack\Paystack::class;
    }
}
