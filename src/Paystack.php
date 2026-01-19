<?php

namespace Scwar\LaravelPaystack;

use Scwar\LaravelPaystack\Contracts\HttpClientInterface;
use Scwar\LaravelPaystack\Resources\Transaction;
use Scwar\LaravelPaystack\Resources\Customer;
use Scwar\LaravelPaystack\Resources\Subscription;
use Scwar\LaravelPaystack\Resources\Plan;
use Scwar\LaravelPaystack\Resources\Product;
use Scwar\LaravelPaystack\Resources\Subaccount;
use Scwar\LaravelPaystack\Resources\Split;
use Scwar\LaravelPaystack\Resources\VirtualAccount;
use Scwar\LaravelPaystack\Resources\Transfer;
use Scwar\LaravelPaystack\Resources\TransferRecipient;
use Scwar\LaravelPaystack\Resources\ApplePay;
use Scwar\LaravelPaystack\Resources\Dispute;
use Scwar\LaravelPaystack\Resources\Refund;
use Scwar\LaravelPaystack\Resources\Verification;
use Scwar\LaravelPaystack\Resources\Miscellaneous;

class Paystack
{
    protected HttpClientInterface $client;

    protected ?Transaction $transaction = null;
    protected ?Customer $customer = null;
    protected ?Subscription $subscription = null;
    protected ?Plan $plan = null;
    protected ?Product $product = null;
    protected ?Subaccount $subaccount = null;
    protected ?Split $split = null;
    protected ?VirtualAccount $virtualAccount = null;
    protected ?Transfer $transfer = null;
    protected ?TransferRecipient $transferRecipient = null;
    protected ?ApplePay $applePay = null;
    protected ?Dispute $dispute = null;
    protected ?Refund $refund = null;
    protected ?Verification $verification = null;
    protected ?Miscellaneous $miscellaneous = null;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function transaction(): Transaction
    {
        if (!$this->transaction) {
            $this->transaction = new Transaction($this->client);
        }

        return $this->transaction;
    }

    public function customer(): Customer
    {
        if (!$this->customer) {
            $this->customer = new Customer($this->client);
        }

        return $this->customer;
    }

    public function subscription(): Subscription
    {
        if (!$this->subscription) {
            $this->subscription = new Subscription($this->client);
        }

        return $this->subscription;
    }

    public function plan(): Plan
    {
        if (!$this->plan) {
            $this->plan = new Plan($this->client);
        }

        return $this->plan;
    }

    public function product(): Product
    {
        if (!$this->product) {
            $this->product = new Product($this->client);
        }

        return $this->product;
    }

    public function subaccount(): Subaccount
    {
        if (!$this->subaccount) {
            $this->subaccount = new Subaccount($this->client);
        }

        return $this->subaccount;
    }

    public function split(): Split
    {
        if (!$this->split) {
            $this->split = new Split($this->client);
        }

        return $this->split;
    }

    public function virtualAccount(): VirtualAccount
    {
        if (!$this->virtualAccount) {
            $this->virtualAccount = new VirtualAccount($this->client);
        }

        return $this->virtualAccount;
    }

    public function transfer(): Transfer
    {
        if (!$this->transfer) {
            $this->transfer = new Transfer($this->client);
        }

        return $this->transfer;
    }

    public function transferRecipient(): TransferRecipient
    {
        if (!$this->transferRecipient) {
            $this->transferRecipient = new TransferRecipient($this->client);
        }

        return $this->transferRecipient;
    }

    public function applePay(): ApplePay
    {
        if (!$this->applePay) {
            $this->applePay = new ApplePay($this->client);
        }

        return $this->applePay;
    }

    public function dispute(): Dispute
    {
        if (!$this->dispute) {
            $this->dispute = new Dispute($this->client);
        }

        return $this->dispute;
    }

    public function refund(): Refund
    {
        if (!$this->refund) {
            $this->refund = new Refund($this->client);
        }

        return $this->refund;
    }

    public function verification(): Verification
    {
        if (!$this->verification) {
            $this->verification = new Verification($this->client);
        }

        return $this->verification;
    }

    public function miscellaneous(): Miscellaneous
    {
        if (!$this->miscellaneous) {
            $this->miscellaneous = new Miscellaneous($this->client);
        }

        return $this->miscellaneous;
    }
}
