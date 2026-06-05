<?php

declare(strict_types=1);

namespace App\Filament\Concerns;

use Illuminate\Support\Facades\Auth;

/**
 * Restricts a Filament resource to administrators only. Other staff roles
 * (ministry managers, coordinators) are confined to the registrations area,
 * so they may neither see the navigation entry nor reach the URLs directly.
 */
trait AdminOnlyResource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }
}
