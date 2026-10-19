<?php

declare(strict_types=1);

namespace App\Filament\Resources\Donations;

use App\Filament\Concerns\AdminOnlyResource;
use App\Filament\Resources\Donations\Pages\ListDonations;
use App\Filament\Resources\Donations\Tables\DonationsTable;
use App\Models\Donation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;
use UnitEnum;

final class DonationResource extends Resource
{
    use AdminOnlyResource;

    protected static ?string $model = Donation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|UnitEnum|null $navigationGroup = 'Conference';

    protected static ?int $navigationSort = 2;

    #[Override]
    public static function table(Table $table): Table
    {
        return DonationsTable::configure($table);
    }

    #[Override]
    public static function canCreate(): bool
    {
        return false;
    }

    #[Override]
    public static function getPages(): array
    {
        return [
            'index' => ListDonations::route('/'),
        ];
    }
}
