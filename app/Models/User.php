<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * @property ?UserRole $role
 */
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    /**
     * Determine if the user can access the Filament admin panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role !== null;
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Determine if the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    /**
     * Determine if the user is a ministry manager.
     */
    public function isMinistryManager(): bool
    {
        return $this->role === UserRole::MinistryManager;
    }

    /**
     * Determine if the user is a coordinator.
     */
    public function isCoordinator(): bool
    {
        return $this->role === UserRole::Coordinator;
    }

    /**
     * Determine if the user holds at least the given role's privileges.
     */
    public function hasRoleAtLeast(UserRole $role): bool
    {
        return $this->role !== null && $this->role->atLeast($role);
    }

    /**
     * Determine if the user may approve or reject applications.
     */
    public function canManageApplications(): bool
    {
        return $this->role?->canManageApplications() ?? false;
    }

    /**
     * Determine if the user is confined to the registrations area.
     */
    public function isLimitedToRegistrations(): bool
    {
        return $this->role?->isLimitedToRegistrations() ?? false;
    }

    /**
     * Get registrations directly linked to this user.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get all registrations for this user (by user_id or email).
     *
     * @return Collection<int, Registration>
     */
    public function allRegistrations(): Collection
    {
        return Registration::forUser($this)->get();
    }
}
