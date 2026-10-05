<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use App\Models\Registration;
use App\Services\StripeService;
use Livewire\Livewire;
use Tests\TestCase;

beforeEach(function (): void {
    /** @var TestCase $this */
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

it('prices a 1-day group of 5 at 4900 HUF per person', function (): void {
    submitGroupForm(['group_duration' => '1_day', 'group_day' => 'saturday', 'group_size' => 5]);

    $registration = Registration::query()->where('email', 'group@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeTrue()
        ->and($registration->ticket_type)->toBe('1_day')
        ->and($registration->ticket_quantity)->toBe(5)
        ->and($registration->ticket_day)->toBe('saturday')
        ->and((int) $registration->amount)->toBe(5 * 4900 * 100);
});

it('prices the largest 1-day group of 9 by the number of people', function (): void {
    submitGroupForm(['group_duration' => '1_day', 'group_day' => 'sunday', 'group_size' => 9]);

    $registration = Registration::query()->where('email', 'group@example.com')->firstOrFail();

    expect($registration->ticket_quantity)->toBe(9)
        ->and((int) $registration->amount)->toBe(9 * 4900 * 100);
});

it('rejects a group larger than 9 people', function (): void {
    submitGroupForm(['email' => 'large@example.com', 'group_size' => 10]);

    expect(Registration::query()->where('email', 'large@example.com')->exists())->toBeFalse();
});

it('charges a fixed 40000 HUF for the 3-day group ticket of 10 people', function (): void {
    submitGroupForm(['email' => 'ten@example.com', 'ticket_kind' => 'group_of_ten', 'group_duration' => null, 'group_day' => null]);

    $registration = Registration::query()->where('email', 'ten@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeTrue()
        ->and($registration->ticket_type)->toBe('3_days')
        ->and($registration->ticket_quantity)->toBe(10)
        ->and($registration->ticket_day)->toBeNull()
        ->and((int) $registration->amount)->toBe(40000 * 100);
});

it('preselects the 10-person group ticket from the home page link', function (): void {
    Livewire::withQueryParams(['kind' => 'group_of_ten'])
        ->test(RegistrationForm::class, ['type' => 'attendee'])
        ->assertSet('data.ticket_kind', 'group_of_ten');
});

it('prices a 3-day group at 9900 HUF per person and stores no day', function (): void {
    submitGroupForm(['group_duration' => '3_days', 'group_day' => null, 'group_size' => 8]);

    $registration = Registration::query()->where('email', 'group@example.com')->firstOrFail();

    expect($registration->ticket_type)->toBe('3_days')
        ->and($registration->ticket_day)->toBeNull()
        ->and((int) $registration->amount)->toBe(8 * 9900 * 100);
});

it('rejects a group smaller than 2 people even when the hidden field is tampered with', function (): void {
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
            'group_size' => 1,
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit')
        ->assertHasFormErrors(['group_size']);

    expect(Registration::query()->where('email', 'small@example.com')->exists())->toBeFalse();
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
            'ticket_price_option' => 'standard',
            'individual_day' => 'saturday',
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit');

    $registration = Registration::query()->where('email', 'individual@example.com')->firstOrFail();

    expect($registration->is_group_ticket)->toBeFalse()
        ->and($registration->ticket_quantity)->toBe(1)
        ->and($registration->ticket_day)->toBe('saturday')
        ->and((int) $registration->amount)->toBe(490000);
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
            'ticket_price_option' => 'standard',
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
            'ticket_price_option' => 'standard',
            'wants_to_evangelize' => 0,
            'accepts_terms' => true,
        ])
        ->call('submit');

    $registration = Registration::query()->where('email', 'three-day@example.com')->firstOrFail();

    expect($registration->ticket_type)->toBe('3_days')
        ->and($registration->ticket_day)->toBeNull()
        ->and((int) $registration->amount)->toBe(990000);
});

it('clears the individual day when switching to a 3-day ticket', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_kind', 'individual')
        ->set('data.ticket_duration', '1_day')
        ->set('data.individual_day', 'friday')
        ->set('data.ticket_duration', '3_days')
        ->assertSet('data.individual_day', null);
});

it('admits 2 people per ticket and 10 for the group-of-ten ticket', function (): void {
    $component = Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_kind', 'individual');

    expect($component->instance()->ticketSummary()['seats'])->toBe(2);

    $component->set('data.ticket_kind', 'group')->set('data.group_size', 9);

    expect($component->instance()->ticketSummary()['seats'])->toBe(18)
        ->and($component->instance()->ticketSummary()['amount_huf'])->toBe(9 * 4900);

    $component->set('data.ticket_kind', 'group_of_ten');

    expect($component->instance()->ticketSummary()['seats'])->toBe(10);
});
