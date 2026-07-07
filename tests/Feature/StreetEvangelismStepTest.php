<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use App\Models\Registration;
use App\Services\StripeService;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;

function submitAttendeeForm(bool $wantsToEvangelize): Testable
{
    return Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->fillForm([
            'first_name' => 'Anna',
            'last_name' => 'Kovács',
            'email' => 'anna@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'ticket_duration' => '1_day',
            'ticket_price_option' => '7500',
            'individual_day' => 'friday',
            // Filament's boolean radio submits the option key ("1"/"0"), matching what the browser sends.
            'wants_to_evangelize' => $wantsToEvangelize ? 1 : 0,
            'accepts_terms' => true,
        ])
        ->call('submit');
}

beforeEach(function (): void {
    $this->mock(StripeService::class)
        ->shouldReceive('createCheckoutSession')
        ->andReturn('https://stripe.test/checkout');
});

it('defaults the street evangelism choice to false', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->assertSet('data.wants_to_evangelize', false);
});

it('persists an opted-in street evangelism choice for attendees', function (): void {
    submitAttendeeForm(true);

    $registration = Registration::query()->where('email', 'anna@example.com')->firstOrFail();

    expect($registration->wants_to_evangelize)->toBeTrue();
});

it('persists a declined street evangelism choice for attendees', function (): void {
    submitAttendeeForm(false);

    $registration = Registration::query()->where('email', 'anna@example.com')->firstOrFail();

    expect($registration->wants_to_evangelize)->toBeFalse();
});
