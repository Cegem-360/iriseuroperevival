<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Registration;
use Exception;
use Illuminate\Support\Facades\Date;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\StripeClient;

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

        // Create or retrieve Stripe Customer with billing details
        $customer = $this->findOrCreateCustomer($registration);

        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('register.success', ['uuid' => $registration->uuid]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('register.cancel', ['uuid' => $registration->uuid]),
            'customer' => $customer->id,
            'metadata' => [
                'registration_id' => $registration->id,
                'registration_uuid' => $registration->uuid,
                'type' => $registration->type,
            ],
            'billing_address_collection' => 'required',
            'allow_promotion_codes' => true,
        ]);

        // Save the session ID and customer ID
        $registration->update([
            'stripe_session_id' => $session->id,
            'stripe_customer_id' => $customer->id,
        ]);

        return $session->url;
    }

    /**
     * Find or create a Stripe Customer for the registration.
     */
    protected function findOrCreateCustomer(Registration $registration): Customer
    {
        // If registration already has a customer ID, retrieve it
        if ($registration->stripe_customer_id) {
            try {
                return $this->stripe->customers->retrieve($registration->stripe_customer_id);
            } catch (Exception) {
                // Customer doesn't exist, create a new one
            }
        }

        // Search for existing customer by email
        $existingCustomers = $this->stripe->customers->search([
            'query' => "email:'{$registration->email}'",
            'limit' => 1,
        ]);

        if ($existingCustomers->data) {
            $customer = $existingCustomers->data[0];

            // Update customer with latest billing details
            return $this->stripe->customers->update($customer->id, [
                'name' => $registration->full_name,
                'phone' => $registration->phone,
                'address' => $this->buildAddress($registration),
            ]);
        }

        // Create new customer
        return $this->stripe->customers->create([
            'email' => $registration->email,
            'name' => $registration->full_name,
            'phone' => $registration->phone,
            'address' => $this->buildAddress($registration),
            'metadata' => [
                'registration_uuid' => $registration->uuid,
            ],
        ]);
    }

    /**
     * Build address array for Stripe.
     */
    protected function buildAddress(Registration $registration): array
    {
        return array_filter([
            'city' => $registration->city,
            'country' => $registration->country,
        ]);
    }

    /**
     * Build line items for the checkout session.
     */
    protected function buildLineItems(Registration $registration): array
    {
        $tier = $this->getCurrentPricingTier();
        $ticketType = $registration->type === 'volunteer' ? 'volunteer' : $registration->ticket_type;
        $pricePerTicket = $this->getTicketPrice($ticketType, $tier);

        $ticketName = match ($ticketType) {
            'team' => 'Europe Revival 2026 - Team Pass',
            'volunteer' => 'Europe Revival 2026 - Volunteer Pass',
            default => 'Europe Revival 2026 - Individual Ticket',
        };

        $description = "August 6-9, 2026 | Budapest, Hungary | {$tier} pricing";

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
                'quantity' => $registration->ticket_quantity ?? 1,
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
                'individual' => 4900,   // €49
                'team' => 3900,         // €39
                'volunteer' => 2900,    // €29 - Volunteer discounted rate
            ],
            'regular' => [
                'individual' => 5900,   // €59
                'team' => 4900,         // €49
                'volunteer' => 3900,    // €39 - Volunteer discounted rate
            ],
            'late' => [
                'individual' => 6900,   // €69
                'team' => 5900,         // €59
                'volunteer' => 4900,    // €49 - Volunteer discounted rate
            ],
        ];

        return $prices[$tier][$ticketType] ?? $prices['late']['individual'];
    }

    /**
     * Get volunteer ticket price for the current tier.
     */
    public function getVolunteerPrice(): int
    {
        return $this->getTicketPrice('volunteer', $this->getCurrentPricingTier());
    }

    /**
     * Determine the current pricing tier based on date.
     */
    public function getCurrentPricingTier(): string
    {
        $now = Date::now();

        // Early Bird: Until June 30, 2026
        $earlyBirdEnd = Date::create(2026, 6, 30, 23, 59, 59);

        // Regular: July 1 - August 31, 2026
        $regularEnd = Date::create(2026, 8, 31, 23, 59, 59);

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

        $registration = Registration::query()->where('stripe_session_id', $sessionId)->first();

        if (! $registration) {
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
        if (! $registration->stripe_payment_intent) {
            return false;
        }

        $params = ['payment_intent' => $registration->stripe_payment_intent];

        if ($amount) {
            $params['amount'] = $amount;
        }

        try {
            $this->stripe->refunds->create($params);

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
