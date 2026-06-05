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
