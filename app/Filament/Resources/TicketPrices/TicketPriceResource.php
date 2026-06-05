<?php

declare(strict_types=1);

namespace App\Filament\Resources\TicketPrices;

use App\Filament\Concerns\AdminOnlyResource;
use App\Filament\Resources\TicketPrices\Pages\CreateTicketPrice;
use App\Filament\Resources\TicketPrices\Pages\EditTicketPrice;
use App\Filament\Resources\TicketPrices\Pages\ListTicketPrices;
use App\Filament\Resources\TicketPrices\Schemas\TicketPriceForm;
use App\Filament\Resources\TicketPrices\Tables\TicketPricesTable;
use App\Models\TicketPrice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;
use UnitEnum;

class TicketPriceResource extends Resource
{
    use AdminOnlyResource;

    protected static ?string $model = TicketPrice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected static string|UnitEnum|null $navigationGroup = 'Shop';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return TicketPriceForm::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return TicketPricesTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTicketPrices::route('/'),
            'create' => CreateTicketPrice::route('/create'),
            'edit' => EditTicketPrice::route('/{record}/edit'),
        ];
    }
}
