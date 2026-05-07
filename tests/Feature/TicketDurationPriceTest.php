<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use Livewire\Livewire;

it('shows 1-day prices by default', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->assertSet('data.ticket_duration', '1_day')
        ->assertSet('data.ticket_price_option', '7500');
});

it('resets to 3-day prices when switching to 3 days', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_duration', '3_days')
        ->assertSet('data.ticket_price_option', '15000');
});

it('resets to 1-day prices when switching back from 3 days', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_duration', '3_days')
        ->assertSet('data.ticket_price_option', '15000')
        ->set('data.ticket_duration', '1_day')
        ->assertSet('data.ticket_price_option', '7500');
});

it('clears custom amount when switching ticket duration', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'attendee'])
        ->set('data.ticket_price_option', 'custom')
        ->set('data.ticket_custom_amount', 50)
        ->set('data.ticket_duration', '3_days')
        ->assertSet('data.ticket_custom_amount', null);
});
