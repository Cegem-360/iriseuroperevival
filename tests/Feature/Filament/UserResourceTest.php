<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

test('admins can list users', function (): void {
    $admin = User::factory()->admin()->create();
    $others = User::factory()->count(3)->coordinator()->create();

    actingAs($admin);

    Livewire::test(ListUsers::class)
        ->assertCanSeeTableRecords($others->push($admin));
});

test('non-admin roles cannot view the user resource', function (string $state): void {
    actingAs(User::factory()->{$state}()->create());

    $this->get(route('filament.admin.resources.users.index'))
        ->assertForbidden();
})->with(['ministryManager', 'coordinator']);

test('admins can create a user with a role', function (): void {
    actingAs(User::factory()->admin()->create());

    Livewire::test(CreateUser::class)
        ->fillForm([
            'name' => 'New Coordinator',
            'email' => 'coordinator@example.com',
            'role' => UserRole::Coordinator->value,
            'password' => 'secret-password',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas(User::class, [
        'email' => 'coordinator@example.com',
        'role' => UserRole::Coordinator->value,
    ]);
});

test('created user password is hashed', function (): void {
    actingAs(User::factory()->admin()->create());

    Livewire::test(CreateUser::class)
        ->fillForm([
            'name' => 'Hashed User',
            'email' => 'hashed@example.com',
            'role' => UserRole::Admin->value,
            'password' => 'secret-password',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $user = User::query()->where('email', 'hashed@example.com')->sole();

    expect(Hash::check('secret-password', $user->password))->toBeTrue();
});

test('name, email and role are required on create', function (): void {
    actingAs(User::factory()->admin()->create());

    Livewire::test(CreateUser::class)
        ->fillForm([
            'name' => '',
            'email' => '',
            'role' => null,
            'password' => '',
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);
});

test('editing without a new password keeps the existing one', function (): void {
    actingAs(User::factory()->admin()->create());

    $target = User::factory()->coordinator()->create([
        'password' => Hash::make('original-password'),
    ]);

    Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
        ->fillForm([
            'name' => 'Renamed',
            'password' => '',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($target->refresh())
        ->name->toBe('Renamed')
        ->and(Hash::check('original-password', $target->password))->toBeTrue();
});

test('admins can promote a coordinator to ministry manager', function (): void {
    actingAs(User::factory()->admin()->create());

    $target = User::factory()->coordinator()->create();

    Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
        ->fillForm([
            'role' => UserRole::MinistryManager->value,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($target->refresh()->role)->toBe(UserRole::MinistryManager);
});

test('newly created users are verified by default', function (): void {
    actingAs(User::factory()->admin()->create());

    Livewire::test(CreateUser::class)
        ->fillForm([
            'name' => 'Verified User',
            'email' => 'verified@example.com',
            'role' => UserRole::Coordinator->value,
            'password' => 'secret-password',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(User::query()->where('email', 'verified@example.com')->sole()->email_verified_at)->not->toBeNull();
});

test('admins can revoke a users email verification', function (): void {
    actingAs(User::factory()->admin()->create());

    $target = User::factory()->coordinator()->create();
    expect($target->email_verified_at)->not->toBeNull();

    Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
        ->fillForm([
            'email_verified_at' => false,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($target->refresh()->email_verified_at)->toBeNull();
});

test('editing keeps the original verification timestamp', function (): void {
    actingAs(User::factory()->admin()->create());

    $verifiedAt = now()->subMonth()->startOfDay();
    $target = User::factory()->coordinator()->create(['email_verified_at' => $verifiedAt]);

    Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
        ->fillForm([
            'name' => 'Still Verified',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($target->refresh()->email_verified_at->equalTo($verifiedAt))->toBeTrue();
});
