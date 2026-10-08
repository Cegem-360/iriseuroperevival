<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use App\Models\Registration;
use App\Services\StripeService;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

beforeEach(function (): void {
    /** @var TestCase $this */
    $this->mock(StripeService::class)
        ->shouldReceive('createCheckoutSession')
        ->andReturn('https://stripe.test/checkout');
});

function submitIndividualForm(array $overrides = []): Testable
{
    return Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->fillForm(array_merge([
            'first_name' => 'Béla',
            'last_name' => 'Nagy',
            'email' => 'individual@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'ticket_kind' => 'individual',
            'ticket_duration' => '1_day',
            'individual_day' => 'saturday',
            'ticket_price_option' => 'standard',
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ], $overrides))
        ->call('submit');
}

it('shows a ticket count stepper only for group tickets', function (): void {
    $component = Livewire::test(RegistrationForm::class, ['type' => 'attendee']);

    $component->assertDontSee('Number of Tickets')
        ->assertSee('One ticket for 2 people.');

    $component->set('data.ticket_kind', 'group')
        ->assertSee('Number of Tickets')
        ->assertSee('data.group_size', false);
});

it('stores an individual order as a single ticket', function (): void {
    submitIndividualForm();

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeFalse()
        ->and($registration->ticket_quantity)->toBe(1)
        ->and((int) $registration->amount)->toBe(4900 * 100);
});

it('ignores a tampered individual quantity and charges a single ticket', function (): void {
    submitIndividualForm(['individual_quantity' => 29]);

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->ticket_quantity)->toBe(1)
        ->and((int) $registration->amount)->toBe(4900 * 100);
});

it('charges the 3-day price for a single ticket and stores no day', function (): void {
    submitIndividualForm([
        'ticket_duration' => '3_days',
        'individual_day' => null,
    ]);

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->ticket_type)->toBe('3_days')
        ->and($registration->ticket_quantity)->toBe(1)
        ->and($registration->ticket_day)->toBeNull()
        ->and((int) $registration->amount)->toBe(9900 * 100);
});

it('accepts a custom amount above the standard price', function (): void {
    submitIndividualForm([
        'ticket_price_option' => 'custom',
        'ticket_custom_amount' => 30000,
    ]);

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->ticket_quantity)->toBe(1)
        ->and((int) $registration->amount)->toBe(30000 * 100);
});

it('requires a custom amount above the standard price of one ticket', function (): void {
    submitIndividualForm([
        'ticket_price_option' => 'custom',
        'ticket_custom_amount' => 4900,
    ])->assertHasFormErrors(['ticket_custom_amount']);

    expect(Registration::query()->where('email', 'individual@example.com')->exists())->toBeFalse();
});
