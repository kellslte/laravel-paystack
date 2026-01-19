<?php

namespace Scwar\LaravelPaystack\Webhooks;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebhookEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly string $event,
        public readonly array $data
    ) {
    }
}
