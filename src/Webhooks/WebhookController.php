<?php

namespace Scwar\LaravelPaystack\Webhooks;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;

class WebhookController
{
    /**
     * Handle incoming webhook.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        if (!isset($payload['event']) || !isset($payload['data'])) {
            return response()->json(['status' => false, 'message' => 'Invalid webhook payload'], 400);
        }

        // Dispatch Laravel event
        Event::dispatch(new WebhookEvent(
            event: $payload['event'],
            data: $payload['data']
        ));

        return response()->json(['status' => true]);
    }
}
