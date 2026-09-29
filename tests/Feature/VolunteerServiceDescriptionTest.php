<?php

declare(strict_types=1);

use App\Livewire\RegistrationForm;
use App\Models\Registration;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Livewire\Livewire;

beforeEach(function (): void {
    Mail::fake();
});

it('stores a long previous service description for a volunteer application', function (): void {
    $description = Str::repeat('Served as an usher and translator at camps. ', 34);

    Livewire::test(RegistrationForm::class, ['type' => 'volunteer'])
        ->fillForm([
            'first_name' => 'Anna',
            'last_name' => 'Kovács',
            'email' => 'volunteer-long@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'languages' => ['Hungarian', 'English'],
            'service_areas' => ['Ushers', 'Translators'],
            'has_served_before' => true,
            'previous_service_description' => $description,
            'accepts_terms' => true,
        ])
        ->call('submit')
        ->assertHasNoFormErrors();

    $registration = Registration::query()->where('email', 'volunteer-long@example.com')->firstOrFail();

    expect(mb_strlen($description))->toBeGreaterThan(1000)
        ->and($registration->previous_service_description)->toBe($description);
});

it('rejects a previous service description over 2000 characters', function (): void {
    Livewire::test(RegistrationForm::class, ['type' => 'volunteer'])
        ->fillForm([
            'has_served_before' => true,
            'previous_service_description' => Str::repeat('a', 2001),
        ])
        ->call('submit')
        ->assertHasFormErrors(['previous_service_description' => 'max']);
});

it('uses a text column for the previous service description', function (): void {
    expect(Schema::getColumnType('registrations', 'previous_service_description'))->toBe('text');
});
