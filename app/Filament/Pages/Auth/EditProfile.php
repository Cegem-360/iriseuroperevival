<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BasePage;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Get;

final class EditProfile extends BasePage
{
    public function getTitle(): string
    {
        return 'Profil szerkesztése';
    }

    public function getHeading(): string
    {
        return 'Profil szerkesztése';
    }

    public static function getLabel(): string
    {
        return 'Profil';
    }

    public static function getNavigationLabel(): string
    {
        return 'Profil';
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Név')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('E-mail cím')
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(ignoreRecord: true);
    }

    protected function getPasswordFormComponent(): Component
    {
        return parent::getPasswordFormComponent()
            ->label('Új jelszó')
            ->helperText('Hagyd üresen, ha nem szeretnéd megváltoztatni.');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return parent::getPasswordConfirmationFormComponent()
            ->label('Új jelszó megerősítése')
            ->visible(fn (Get $get): bool => filled($get('password')));
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Profil sikeresen mentve';
    }
}
