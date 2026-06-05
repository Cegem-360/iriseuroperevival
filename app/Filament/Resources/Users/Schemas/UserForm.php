<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\User;
use DateTimeInterface;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Select::make('role')
                            ->options(UserRole::class)
                            ->required()
                            ->native(false)
                            ->helperText('Administrators manage users; ministry managers approve applications; coordinators have read-only operational access.'),
                        Toggle::make('email_verified_at')
                            ->label('Email verified')
                            ->default(true)
                            ->formatStateUsing(fn ($state): bool => filled($state))
                            ->dehydrateStateUsing(fn (bool $state, ?User $record): ?DateTimeInterface => $state
                                ? ($record?->email_verified_at ?? now())
                                : null),
                    ]),
                Section::make('Password')
                    ->columns(1)
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->maxLength(255)
                            ->helperText('Leave blank to keep the current password when editing.'),
                    ]),
            ]);
    }
}
