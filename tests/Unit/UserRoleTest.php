<?php

declare(strict_types=1);

use App\Enums\UserRole;

test('roles are ordered by privilege level', function (): void {
    expect(UserRole::Admin->level())->toBe(3)
        ->and(UserRole::MinistryManager->level())->toBe(2)
        ->and(UserRole::Coordinator->level())->toBe(1);
});

test('atLeast compares privilege levels', function (): void {
    expect(UserRole::Admin->atLeast(UserRole::Coordinator))->toBeTrue()
        ->and(UserRole::MinistryManager->atLeast(UserRole::MinistryManager))->toBeTrue()
        ->and(UserRole::Coordinator->atLeast(UserRole::MinistryManager))->toBeFalse();
});

test('only admin and ministry manager can manage applications', function (): void {
    expect(UserRole::Admin->canManageApplications())->toBeTrue()
        ->and(UserRole::MinistryManager->canManageApplications())->toBeTrue()
        ->and(UserRole::Coordinator->canManageApplications())->toBeFalse();
});

test('only admin can manage users', function (): void {
    expect(UserRole::Admin->canManageUsers())->toBeTrue()
        ->and(UserRole::MinistryManager->canManageUsers())->toBeFalse()
        ->and(UserRole::Coordinator->canManageUsers())->toBeFalse();
});

test('each role exposes a human label', function (): void {
    expect(UserRole::Admin->getLabel())->toBe('Administrator')
        ->and(UserRole::MinistryManager->getLabel())->toBe('Ministry Manager')
        ->and(UserRole::Coordinator->getLabel())->toBe('Coordinator');
});
