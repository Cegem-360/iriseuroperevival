<?php

namespace App\Filament\Resources\PromotionCodes;

use Override;
use App\Filament\Resources\PromotionCodes\Pages\CreatePromotionCode;
use App\Filament\Resources\PromotionCodes\Pages\EditPromotionCode;
use App\Filament\Resources\PromotionCodes\Pages\ListPromotionCodes;
use App\Filament\Resources\PromotionCodes\Schemas\PromotionCodeForm;
use App\Filament\Resources\PromotionCodes\Tables\PromotionCodesTable;
use App\Models\PromotionCode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PromotionCodeResource extends Resource
{
    protected static ?string $model = PromotionCode::class;

    protected static ?string $modelLabel = 'Promotion Code';

    protected static ?string $pluralModelLabel = 'Promotion Codes';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected static string|UnitEnum|null $navigationGroup = 'Shop';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return PromotionCodeForm::configure($schema);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return PromotionCodesTable::configure($table);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPromotionCodes::route('/'),
            'create' => CreatePromotionCode::route('/create'),
            'edit' => EditPromotionCode::route('/{record}/edit'),
        ];
    }
}
