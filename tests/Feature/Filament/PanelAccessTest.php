<?php

declare(strict_types=1);

use App\Models\User;

test('every staff role can reach the dashboard', function (string $state): void {
    $user = User::factory()->{$state}()->create();

    $this->actingAs($user)
        ->get(route('filament.admin.pages.dashboard'))
        ->assertOk();
})->with(['admin', 'ministryManager', 'coordinator']);

test('users without a role cannot reach the dashboard', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('filament.admin.pages.dashboard'))
        ->assertForbidden();
});

test('guests are redirected from the dashboard', function (): void {
    $this->get(route('filament.admin.pages.dashboard'))
        ->assertRedirect();
});

test('canAccessPanel reflects whether the user has a role', function (): void {
    $panel = filament()->getPanel('admin');

    expect(User::factory()->admin()->create()->canAccessPanel($panel))->toBeTrue()
        ->and(User::factory()->ministryManager()->create()->canAccessPanel($panel))->toBeTrue()
        ->and(User::factory()->coordinator()->create()->canAccessPanel($panel))->toBeTrue()
        ->and(User::factory()->create()->canAccessPanel($panel))->toBeFalse();
});
