<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Registration;
use App\Models\TicketPrice;
use Exception;
use Illuminate\Support\Facades\Cache;
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
     * Build address array for Stripe (requires ISO 3166-1 alpha-2 country codes).
     */
    protected function buildAddress(Registration $registration): array
    {
        return array_filter([
            'city' => $registration->city,
            'country' => $this->countryToIsoCode($registration->country?->value),
        ]);
    }

    /**
     * Map country name to ISO 3166-1 alpha-2 code for Stripe.
     */
    protected function countryToIsoCode(?string $country): ?string
    {
        if (! $country) {
            return null;
        }

        $map = [
            'Hungary' => 'HU',
            'Germany' => 'DE',
            'Austria' => 'AT',
            'Romania' => 'RO',
            'Slovakia' => 'SK',
            'Czech Republic' => 'CZ',
            'Poland' => 'PL',
            'United Kingdom' => 'GB',
            'United States' => 'US',
        ];

        return $map[$country] ?? null;
    }

    /**
     * Build line items for the checkout session.
     */
    protected function buildLineItems(Registration $registration): array
    {
        $ticketName = 'Europe Revival 2026 — ' . $registration->formatted_ticket_type;

        if ($registration->is_group_ticket) {
            $ticketName .= ' — ' . __('Group Ticket') . ' (' . $registration->ticket_quantity . ' ' . __('person') . ')';
        }

        return [
            [
                'price_data' => [
                    'currency' => 'huf',
                    'product_data' => [
                        'name' => $ticketName,
                        'description' => 'October 22-25, 2026 | Budapest, Hungary',
                        'images' => [
                            asset('images/ticket-image.jpg'),
                        ],
                    ],
                    'unit_amount' => (int) $registration->amount,
                ],
                'quantity' => 1,
            ],
        ];
    }

    /**
     * Get the ticket price based on type and pricing tier.
     */
    public function getTicketPrice(string $ticketType, string $tier): int
    {
        return Cache::remember(
            "ticket_price.{$tier}.{$ticketType}",
            3600,
            function () use ($ticketType, $tier): int {
                $ticketPrice = TicketPrice::query()
                    ->active()
                    ->forTier($tier)
                    ->forType($ticketType)
                    ->first();

                return $ticketPrice?->price ?? $this->getFallbackPrice($ticketType, $tier);
            },
        );
    }

    /**
     * Fallback prices for when the database is not yet seeded.
     */
    protected function getFallbackPrice(string $ticketType, string $tier): int
    {
        $prices = [
            'early' => ['individual' => 4900, 'team' => 3900, 'volunteer' => 2900, 'vip' => 14900],
            'regular' => ['individual' => 5900, 'team' => 4900, 'volunteer' => 3900, 'vip' => 17900],
            'late' => ['individual' => 6900, 'team' => 5900, 'volunteer' => 4900, 'vip' => 19900],
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
     * Get all pricing information for the current tier.
     *
     * @return array{tier: string, individual: int, team: int, volunteer: int, vip: int, team_minimum: int}
     */
    public function getAllPrices(): array
    {
        $tier = $this->getCurrentPricingTier();

        return Cache::remember("ticket_prices.all.{$tier}", 3600, fn (): array => [
            'tier' => $tier,
            'individual' => $this->getTicketPrice('individual', $tier),
            'team' => $this->getTicketPrice('team', $tier),
            'volunteer' => $this->getTicketPrice('volunteer', $tier),
            'vip' => $this->getTicketPrice('vip', $tier),
            'team_minimum' => 10,
        ]);
    }

    /**
     * Get human-readable tier name.
     */
    public function getTierName(): string
    {
        return match ($this->getCurrentPricingTier()) {
            'early' => 'Early Bird',
            'regular' => 'Regular',
            'late' => 'Late Registration',
        };
    }

    /**
     * Get Early Bird end date.
     */
    public function getEarlyBirdEndDate(): string
    {
        return 'August 31, 2026';
    }

    /**
     * Determine the current pricing tier based on date.
     */
    public function getCurrentPricingTier(): string
    {
        $now = Date::now();

        // Early Bird: Until August 31, 2026
        $earlyBirdEnd = Date::create(2026, 8, 31, 23, 59, 59);

        // Regular: September 1 - October 15, 2026
        $regularEnd = Date::create(2026, 10, 15, 23, 59, 59);

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
