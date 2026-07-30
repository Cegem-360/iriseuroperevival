<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use App\Models\Registration;
use App\Services\StripeService;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;

beforeEach(function (): void {
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
            'ticket_price_option' => '7500',
            'individual_quantity' => 1,
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ], $overrides))
        ->call('submit');
}

it('shows a ticket count stepper for individual tickets and a people stepper for groups', function (): void {
    $component = Livewire::test(RegistrationForm::class, ['type' => 'attendee']);

    $component->assertSee('Number of Tickets')
        ->assertSee('data.individual_quantity', false)
        ->assertDontSee('Number of People');

    $component->set('data.ticket_kind', 'group')
        ->assertSee('Number of People')
        ->assertSee('data.group_size', false)
        ->assertDontSee('Number of Tickets');
});

it('defaults to a single ticket', function (): void {
    submitIndividualForm();

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeFalse()
        ->and($registration->ticket_quantity)->toBe(1)
        ->and((int) $registration->amount)->toBe(7500 * 100);
});

it('multiplies the 1-day price by the number of tickets', function (): void {
    submitIndividualForm(['individual_quantity' => 3]);

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeFalse()
        ->and($registration->ticket_quantity)->toBe(3)
        ->and($registration->ticket_day)->toBe('saturday')
        ->and((int) $registration->amount)->toBe(3 * 7500 * 100);
});

it('multiplies the 3-day price by the number of tickets and stores no day', function (): void {
    submitIndividualForm([
        'ticket_duration' => '3_days',
        'ticket_price_option' => '15000',
        'individual_day' => null,
        'individual_quantity' => 4,
    ]);

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->ticket_type)->toBe('3_days')
        ->and($registration->ticket_quantity)->toBe(4)
        ->and($registration->ticket_day)->toBeNull()
        ->and((int) $registration->amount)->toBe(4 * 15000 * 100);
});

it('allows 5 or more individual tickets without turning them into a group ticket', function (): void {
    submitIndividualForm(['individual_quantity' => 6]);

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeFalse()
        ->and($registration->ticket_quantity)->toBe(6)
        ->and((int) $registration->amount)->toBe(6 * 7500 * 100);
});

it('treats a custom amount as the total for the whole order', function (): void {
    submitIndividualForm([
        'ticket_price_option' => 'custom',
        'ticket_custom_amount' => 30000,
        'individual_quantity' => 3,
    ]);

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->ticket_quantity)->toBe(3)
        ->and((int) $registration->amount)->toBe(30000 * 100);
});

it('requires a custom amount above the standard price of all tickets', function (): void {
    submitIndividualForm([
        'ticket_price_option' => 'custom',
        'ticket_custom_amount' => 20000,
        'individual_quantity' => 3,
    ])->assertHasFormErrors(['ticket_custom_amount']);

    expect(Registration::query()->where('email', 'individual@example.com')->exists())->toBeFalse();
});

it('rejects a tampered quantity below one', function (): void {
    submitIndividualForm(['individual_quantity' => 0])
        ->assertHasFormErrors(['individual_quantity']);

    expect(Registration::query()->where('email', 'individual@example.com')->exists())->toBeFalse();
});
