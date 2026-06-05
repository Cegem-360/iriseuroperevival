<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasColor, HasLabel
{
    case Admin = 'admin';
    case MinistryManager = 'ministry_manager';
    case Coordinator = 'coordinator';

    public function getLabel(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::MinistryManager => 'Ministry Manager',
            self::Coordinator => 'Coordinator',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Admin => 'danger',
            self::MinistryManager => 'warning',
            self::Coordinator => 'info',
        };
    }

    /**
     * The privilege level of the role; higher means more access.
     */
    public function level(): int
    {
        return match ($this) {
            self::Admin => 3,
            self::MinistryManager => 2,
            self::Coordinator => 1,
        };
    }

    /**
     * Determine if this role has at least the privileges of the given role.
     */
    public function atLeast(self $role): bool
    {
        return $this->level() >= $role->level();
    }

    /**
     * Determine if this role may approve or reject ministry and volunteer applications.
     */
    public function canManageApplications(): bool
    {
        return $this->atLeast(self::MinistryManager);
    }

    /**
     * Determine if this role may manage other users.
     */
    public function canManageUsers(): bool
    {
        return $this === self::Admin;
    }

    /**
     * Determine if this role is confined to the registrations area
     * (ministry and volunteer applications only).
     */
    public function isLimitedToRegistrations(): bool
    {
        return $this !== self::Admin;
    }
}
