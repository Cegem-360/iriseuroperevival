<?php

declare(strict_types=1);

use App\Filament\Pages\Auth\EditProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

test('admin users can access the profile page', function (): void {
    $user = User::factory()->create(['is_admin' => true]);

    $this->actingAs($user)
        ->get(route('filament.admin.auth.profile'))
        ->assertOk();
});

test('guests are redirected from the profile page', function (): void {
    $this->get(route('filament.admin.auth.profile'))
        ->assertRedirect();
});

test('non-admin users cannot access the profile page', function (): void {
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('filament.admin.auth.profile'))
        ->assertForbidden();
});

test('admin can update their name and email', function (): void {
    $user = User::factory()->create([
        'is_admin' => true,
        'name' => 'Old Name',
        'email' => 'old@example.com',
    ]);

    $this->actingAs($user);

    Livewire::test(EditProfile::class)
        ->fillForm([
            'name' => 'New Name',
            'email' => 'new@example.com',
            'currentPassword' => 'password',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($user->refresh())
        ->name->toBe('New Name')
        ->email->toBe('new@example.com');
});

test('admin can change their password with current password confirmation', function (): void {
    $user = User::factory()->create([
        'is_admin' => true,
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user);

    Livewire::test(EditProfile::class)
        ->fillForm([
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'new-secret-password',
            'passwordConfirmation' => 'new-secret-password',
            'currentPassword' => 'password',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(Hash::check('new-secret-password', $user->refresh()->password))->toBeTrue();
});

test('name and email are required', function (): void {
    $user = User::factory()->create(['is_admin' => true]);

    $this->actingAs($user);

    Livewire::test(EditProfile::class)
        ->fillForm([
            'name' => '',
            'email' => '',
        ])
        ->call('save')
        ->assertHasFormErrors([
            'name' => 'required',
            'email' => 'required',
        ]);
});
