<?php

use App\Models\Registration;
use App\Models\User;

test('guests are redirected to the login page', function (): void {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function (): void {
    $this->actingAs($user = User::factory()->create());

    $this->get('/dashboard')->assertOk();
});

test('dashboard shows registrations linked to user', function (): void {
    $user = User::factory()->create();
    $registration = Registration::factory()->create([
        'user_id' => $user->id,
        'first_name' => 'John',
        'last_name' => 'Doe',
    ]);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('John')
        ->assertSee($registration->uuid);
});

test('dashboard shows registrations with matching email', function (): void {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $registration = Registration::factory()->create([
        'email' => 'test@example.com',
        'first_name' => 'Jane',
        'last_name' => 'Smith',
    ]);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('Jane')
        ->assertSee($registration->uuid);
});

test('dashboard does not show other users registrations', function (): void {
    $user = User::factory()->create(['email' => 'user@example.com']);
    $otherRegistration = Registration::factory()->create([
        'email' => 'other@example.com',
        'first_name' => 'Other',
        'last_name' => 'Person',
    ]);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertDontSee($otherRegistration->uuid);
});

test('dashboard shows empty state when no registrations', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('No Registrations');
});
