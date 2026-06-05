<?php

declare(strict_types=1);

namespace App\Filament\Resources\Registrations;

use App\Filament\Resources\Registrations\Pages\CreateRegistration;
use App\Filament\Resources\Registrations\Pages\EditRegistration;
use App\Filament\Resources\Registrations\Pages\ListRegistrations;
use App\Filament\Resources\Registrations\RelationManagers\WorkshopsRelationManager;
use App\Filament\Resources\Registrations\Schemas\RegistrationForm;
use App\Filament\Resources\Registrations\Tables\RegistrationsTable;
use App\Models\Registration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Override;
use UnitEnum;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|UnitEnum|null $navigationGroup = 'Conference';

    protected static ?int $navigationSort = 1;

    /**
     * Ministry managers and coordinators only ever see ministry and volunteer
     * applications; administrators see every registration type.
     */
    #[Override]
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Auth::user()?->isLimitedToRegistrations()) {
            $query->whereIn('type', ['ministry', 'volunteer']);
        }

        return $query;
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->canManageApplications() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()?->canManageApplications() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingCount = static::getEloquentQuery()->where('status', 'pending_approval')->count();

        return $pendingCount > 0 ? (string) $pendingCount : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return RegistrationForm::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return RegistrationsTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            WorkshopsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegistrations::route('/'),
            'create' => CreateRegistration::route('/create'),
            'edit' => EditRegistration::route('/{record}/edit'),
        ];
    }
}
