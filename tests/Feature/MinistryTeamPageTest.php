<?php

declare(strict_types=1);

use App\Livewire\Pages\MinistryTeam;
use App\Mail\MinistryApplicationReceived;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders the ministry team page successfully', function () {
    $this->get('/ministry-team')
        ->assertStatus(200)
        ->assertSeeLivewire(MinistryTeam::class);
});

it('displays all service area cards', function () {
    app()->setLocale('hu');

    Livewire::test(MinistryTeam::class)
        ->assertSee('Evangelizációs csoportvezető')
        ->assertSee('Ima a gyógyulásért')
        ->assertSee('Prófétai ima szolgálat')
        ->assertSee('Ima csapat')
        ->assertSee('Vendégfogadás');
});

it('displays the training day schedule', function () {
    app()->setLocale('hu');

    Livewire::test(MinistryTeam::class)
        ->assertSee('Tréning nap')
        ->assertSee('2026. október 22.')
        ->assertSee('David Gava');
});

it('validates required form fields for ministry registration', function () {
    Livewire::test(MinistryTeam::class)
        ->fillForm([
            'registration_type' => 'ministry',
        ])
        ->call('submit')
        ->assertHasFormErrors([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);
});

it('creates a ministry registration with valid data', function () {
    Mail::fake();

    $testimony = str_repeat('Isten megváltoztatta az életemet. ', 5);

    Livewire::test(MinistryTeam::class)
        ->fillForm([
            'registration_type' => 'ministry',
            'first_name' => 'János',
            'last_name' => 'Kovács',
            'email' => 'janos@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'citizenship' => 'Hungarian',
            'languages' => ['English', 'Hungarian'],
            'occupation' => 'Pastor',
            'ministry_areas' => ['prayer_team'],
            'church_name' => 'Test Gyülekezet',
            'church_city' => 'Budapest',
            'pastor_name' => 'Pál Pásztor',
            'pastor_email' => 'pastor@example.com',
            'is_born_again' => true,
            'is_spirit_filled' => true,
            'testimony' => $testimony,
            'reference_1_name' => 'Reference One',
            'reference_1_email' => 'ref1@example.com',
            'reference_2_name' => 'Reference Two',
            'reference_2_email' => 'ref2@example.com',
            'accepts_guidelines' => true,
            'accepts_terms' => true,
        ])
        ->call('submit')
        ->assertHasNoFormErrors()
        ->assertRedirect();

    expect(Registration::query()->count())->toBe(1);

    $registration = Registration::query()->first();
    expect($registration->type)->toBe('ministry');
    expect($registration->first_name)->toBe('János');
    expect($registration->status)->toBe('pending_approval');
});

it('sends confirmation email after ministry submission', function () {
    Mail::fake();

    $testimony = str_repeat('Isten megváltoztatta az életemet. ', 5);

    Livewire::test(MinistryTeam::class)
        ->fillForm([
            'registration_type' => 'ministry',
            'first_name' => 'János',
            'last_name' => 'Kovács',
            'email' => 'janos@example.com',
            'phone' => '+36301234567',
            'country' => 'Hungary',
            'city' => 'Budapest',
            'citizenship' => 'Hungarian',
            'languages' => ['English', 'Hungarian'],
            'occupation' => 'Pastor',
            'ministry_areas' => ['prayer_team'],
            'church_name' => 'Test Gyülekezet',
            'church_city' => 'Budapest',
            'pastor_name' => 'Pál Pásztor',
            'pastor_email' => 'pastor@example.com',
            'is_born_again' => true,
            'is_spirit_filled' => true,
            'testimony' => $testimony,
            'reference_1_name' => 'Reference One',
            'reference_1_email' => 'ref1@example.com',
            'reference_2_name' => 'Reference Two',
            'reference_2_email' => 'ref2@example.com',
            'accepts_guidelines' => true,
            'accepts_terms' => true,
        ])
        ->call('submit')
        ->assertRedirect();

    Mail::assertQueued(MinistryApplicationReceived::class, function ($mail) {
        return $mail->hasTo('janos@example.com');
    });
});
