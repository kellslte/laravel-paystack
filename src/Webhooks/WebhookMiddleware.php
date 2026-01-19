<?php

namespace Scwar\LaravelPaystack\Webhooks;

use Closure;
use Illuminate\Http\Request;
use Scwar\LaravelPaystack\Support\WebhookSignature;
use Symfony\Component\HttpFoundation\Response;

class WebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $secret = config('paystack.webhook_secret');

        if (empty($secret)) {
            abort(500, 'Paystack webhook secret is not configured');
        }

        $signature = $request->header('x-paystack-signature');
        $payload = $request->getContent();

        if (!WebhookSignature::verifyFromRequest($payload, $signature, $secret)) {
            abort(401, 'Invalid webhook signature');
        }

        return $next($request);
    }
}
