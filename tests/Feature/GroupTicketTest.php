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

it('clamps a group smaller than 5 people up to the 5 person minimum', function (): void {
    submitGroupForm(['email' => 'small@example.com', 'group_duration' => '1_day', 'group_day' => 'friday', 'group_size' => 3]);

    $registration = Registration::query()->where('email', 'small@example.com')->firstOrFail();

    expect($registration->ticket_quantity)->toBe(5)
        ->and((int) $registration->amount)->toBe(5 * 7500 * 100);
});

it('stores the chosen day for a 1-day individual ticket', function (): void {
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
            'individual_day' => 'saturday',
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit');

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeFalse()
        ->and($registration->ticket_quantity)->toBe(1)
        ->and($registration->ticket_day)->toBe('saturday')
        ->and((int) $registration->amount)->toBe(750000);
});

it('requires a day for a 1-day individual ticket', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->fillForm([
            'first_name' => 'Béla',
            'last_name' => 'Nagy',
            'email' => 'no-day@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'ticket_kind' => 'individual',
            'ticket_duration' => '1_day',
            'ticket_price_option' => '7500',
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit')
        ->assertHasFormErrors(['individual_day']);

    expect(Registration::query()->where('email', 'no-day@example.com')->exists())->toBeFalse();
});

it('stores no day for a 3-day individual ticket', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->fillForm([
            'first_name' => 'Béla',
            'last_name' => 'Nagy',
            'email' => 'three-day@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'ticket_kind' => 'individual',
            'ticket_duration' => '3_days',
            'ticket_price_option' => '15000',
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit');

    $registration = Registration::query()->where('email', 'three-day@example.com')->firstOrFail();

    expect($registration->ticket_type)->toBe('3_days')
        ->and($registration->ticket_day)->toBeNull()
        ->and((int) $registration->amount)->toBe(1500000);
});

it('clears the individual day when switching to a 3-day ticket', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_kind', 'individual')
        ->set('data.ticket_duration', '1_day')
        ->set('data.individual_day', 'friday')
        ->set('data.ticket_duration', '3_days')
        ->assertSet('data.individual_day', null);
});
