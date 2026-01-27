<?php

namespace App\Http\Controllers;

use App\Services\StripeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Webhook;

class WebhookController extends Controller
{
    /**
     * Handle Stripe webhooks.
     */
    public function handleStripe(Request $request): Response
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (Exception $e) {
            return response('Webhook Error: '.$e->getMessage(), 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            app(StripeService::class)->handlePaymentSuccess($session->id);
        }

        return response('', 200);
    }
}
