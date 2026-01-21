<?php

namespace App\Services;

use App\Models\Registration;
use Stripe\StripeClient;
use Stripe\Checkout\Session;
use Illuminate\Support\Carbon;

class StripeService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout Session for the registration.
     */
    public function createCheckoutSession(Registration $registration): string
    {
        $lineItems = $this->buildLineItems($registration);

        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('register.success', ['uuid' => $registration->uuid]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('register.cancel', ['uuid' => $registration->uuid]),
            'customer_email' => $registration->email,
            'metadata' => [
                'registration_id' => $registration->id,
                'registration_uuid' => $registration->uuid,
                'type' => $registration->type,
            ],
            'billing_address_collection' => 'required',
            'allow_promotion_codes' => true,
        ]);

        // Save the session ID
        $registration->update(['stripe_session_id' => $session->id]);

        return $session->url;
    }

    /**
     * Build line items for the checkout session.
     */
    protected function buildLineItems(Registration $registration): array
    {
        $tier = $this->getCurrentPricingTier();
        $pricePerTicket = $this->getTicketPrice($registration->ticket_type, $tier);
        
        $ticketName = $registration->ticket_type === 'team' 
            ? 'Europe Revival 2026 - Team Pass' 
            : 'Europe Revival 2026 - Individual Ticket';
        
        $description = "October 23-25, 2026 | Budapest, Hungary | {$tier} pricing";

        return [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $ticketName,
                        'description' => $description,
                        'images' => [
                            asset('images/ticket-image.jpg'),
                        ],
                    ],
                    'unit_amount' => $pricePerTicket, // Amount in cents
                ],
                'quantity' => $registration->ticket_quantity,
            ],
        ];
    }

    /**
     * Get the ticket price based on type and pricing tier.
     */
    public function getTicketPrice(string $ticketType, string $tier): int
    {
        $prices = [
            'early' => [
                'individual' => 4900, // €49
                'team' => 3900,       // €39
            ],
            'regular' => [
                'individual' => 5900, // €59
                'team' => 4900,       // €49
            ],
            'late' => [
                'individual' => 6900, // €69
                'team' => 5900,       // €59
            ],
        ];

        return $prices[$tier][$ticketType] ?? $prices['late'][$ticketType];
    }

    /**
     * Determine the current pricing tier based on date.
     */
    public function getCurrentPricingTier(): string
    {
        $now = Carbon::now();
        
        // Early Bird: Until June 30, 2026
        $earlyBirdEnd = Carbon::create(2026, 6, 30, 23, 59, 59);
        
        // Regular: July 1 - August 31, 2026
        $regularEnd = Carbon::create(2026, 8, 31, 23, 59, 59);
        
        if ($now->lte($earlyBirdEnd)) {
            return 'early';
        }
        
        if ($now->lte($regularEnd)) {
            return 'regular';
        }
        
        return 'late';
    }

    /**
     * Handle successful payment webhook.
     */
    public function handlePaymentSuccess(string $sessionId): bool
    {
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);
        
        if ($session->payment_status !== 'paid') {
            return false;
        }

        $registration = Registration::where('stripe_session_id', $sessionId)->first();
        
        if (!$registration) {
            return false;
        }

        return $registration->markAsPaid($session->payment_intent);
    }

    /**
     * Retrieve a checkout session.
     */
    public function retrieveSession(string $sessionId): Session
    {
        return $this->stripe->checkout->sessions->retrieve($sessionId);
    }

    /**
     * Create a refund for a registration.
     */
    public function refund(Registration $registration, ?int $amount = null): bool
    {
        if (!$registration->stripe_payment_intent) {
            return false;
        }

        $params = ['payment_intent' => $registration->stripe_payment_intent];
        
        if ($amount) {
            $params['amount'] = $amount;
        }

        try {
            $this->stripe->refunds->create($params);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
