<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use App\Models\Registration;
use Illuminate\Support\Number;
use Livewire\Livewire;
use Tests\TestCase;

it('selects the standard price by default', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->assertSet('data.ticket_duration', '1_day')
        ->assertSet('data.ticket_price_option', 'standard');
});

it('resets to the standard price when switching ticket duration', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_price_option', 'custom')
        ->set('data.ticket_duration', '3_days')
        ->assertSet('data.ticket_price_option', 'standard')
        ->set('data.ticket_duration', '1_day')
        ->assertSet('data.ticket_price_option', 'standard');
});

it('clears custom amount when switching ticket duration', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_price_option', 'custom')
        ->set('data.ticket_custom_amount', 50)
        ->set('data.ticket_duration', '3_days')
        ->assertSet('data.ticket_custom_amount', null);
});

it('prices the 3-day standard ticket at 9900 HUF', function (): void {
    $component = Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_duration', '3_days')
        ->set('data.ticket_price_option', 'standard');

    expect($component->instance()->getFormattedPrice())->toMatch('/9[\s\x{00a0}\x{202f},.]?900/u');
});

it('prices the 1-day standard ticket at 4900 HUF', function (): void {
    $component = Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_duration', '1_day')
        ->set('data.ticket_price_option', 'standard');

    expect($component->instance()->getFormattedPrice())->toMatch('/4[\s\x{00a0}\x{202f},.]?900/u');
});

it('keeps legacy numeric price links working as the standard price', function (): void {
    /** @var TestCase $this */
    $this->get(route('register', ['duration' => '3_days', 'price' => '15000']))->assertOk();

    Livewire::withQueryParams(['duration' => '3_days', 'price' => '15000'])
        ->test(RegistrationForm::class, ['type' => 'attendee'])
        ->assertSet('data.ticket_price_option', 'standard');
});

it('shows the new supporter prices on the home page', function (): void {
    /** @var TestCase $this */
    $this->get('/')
        ->assertOk()
        ->assertSee(Number::currency(Registration::ONE_DAY_PRICE_HUF, 'HUF', 'en', 0))
        ->assertSee(Number::currency(Registration::THREE_DAY_PRICE_HUF, 'HUF', 'en', 0))
        ->assertDontSee(Number::currency(7500, 'HUF', 'en', 0))
        ->assertSeeHtml('selected: \'standard\'');
});
