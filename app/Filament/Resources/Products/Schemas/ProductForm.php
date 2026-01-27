<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->maxLength(255)
                            ->helperText('Leave empty to auto-generate from name'),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Select::make('type')
                            ->options([
                                'merchandise' => 'Merchandise',
                                'ticket' => 'Ticket',
                                'donation' => 'Donation',
                            ])
                            ->default('merchandise')
                            ->required(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->suffix('cents')
                            ->helperText('Price in cents (e.g., 2500 = 25.00 €)')
                            ->minValue(0),
                    ]),
                Section::make('Inventory')
                    ->columns(2)
                    ->schema([
                        TextInput::make('stock_quantity')
                            ->numeric()
                            ->minValue(0)
                            ->helperText('Leave empty for unlimited stock'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ]),
                Section::make('Image')
                    ->schema([
                        FileUpload::make('image_path')
                            ->image()
                            ->directory('products')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),
                Section::make('Attributes')
                    ->collapsed()
                    ->schema([
                        KeyValue::make('attributes')
                            ->keyLabel('Attribute')
                            ->valueLabel('Options (comma-separated)')
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),
                Section::make('Status')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
