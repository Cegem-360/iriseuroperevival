<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use App\Models\Registration;
use App\Services\StripeService;
use Livewire\Livewire;

beforeEach(function (): void {
    $this->mock(StripeService::class)
        ->shouldReceive('createCheckoutSession')
        ->andReturn('https://stripe.test/checkout');
});

function submitGroupForm(array $overrides = []): void
{
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->fillForm(array_merge([
            'first_name' => 'Anna',
            'last_name' => 'Kovács',
            'email' => 'group@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'ticket_kind' => 'group',
            'group_duration' => '1_day',
            'group_day' => 'friday',
            'group_size' => 5,
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ], $overrides))
        ->call('submit');
}

it('prices a 1-day group of 5 at 7500 HUF per person', function (): void {
    submitGroupForm(['group_duration' => '1_day', 'group_day' => 'saturday', 'group_size' => 5]);

    $registration = Registration::query()->where('email', 'group@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeTrue()
        ->and($registration->ticket_type)->toBe('1_day')
        ->and($registration->ticket_quantity)->toBe(5)
        ->and($registration->ticket_day)->toBe('saturday')
        ->and((int) $registration->amount)->toBe(5 * 7500 * 100);
});

it('prices a larger 1-day group by the number of people', function (): void {
    submitGroupForm(['group_duration' => '1_day', 'group_day' => 'sunday', 'group_size' => 12]);

    $registration = Registration::query()->where('email', 'group@example.com')->firstOrFail();

    expect($registration->ticket_quantity)->toBe(12)
        ->and((int) $registration->amount)->toBe(12 * 7500 * 100);
});

it('prices a 3-day group at 15000 HUF per person and stores no day', function (): void {
    submitGroupForm(['group_duration' => '3_days', 'group_day' => null, 'group_size' => 8]);

    $registration = Registration::query()->where('email', 'group@example.com')->firstOrFail();

    expect($registration->ticket_type)->toBe('3_days')
        ->and($registration->ticket_day)->toBeNull()
        ->and((int) $registration->amount)->toBe(8 * 15000 * 100);
});

it('rejects a group smaller than 5 people', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->fillForm([
            'first_name' => 'Anna',
            'last_name' => 'Kovács',
            'email' => 'small@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'ticket_kind' => 'group',
            'group_duration' => '1_day',
            'group_day' => 'friday',
            'group_size' => 3,
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit')
        ->assertHasFormErrors(['group_size']);

    expect(Registration::query()->where('email', 'small@example.com')->exists())->toBeFalse();
});

it('still processes an individual ticket unchanged', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->fillForm([
            'first_name' => 'Béla',
            'last_name' => 'Nagy',
            'email' => 'individual@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'ticket_kind' => 'individual',
            'ticket_duration' => '1_day',
            'ticket_price_option' => '7500',
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit');

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeFalse()
        ->and($registration->ticket_quantity)->toBe(1)
        ->and((int) $registration->amount)->toBe(750000);
});
