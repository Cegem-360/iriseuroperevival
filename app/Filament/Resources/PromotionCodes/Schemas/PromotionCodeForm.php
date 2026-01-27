<?php

declare(strict_types=1);

namespace App\Filament\Resources\PromotionCodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PromotionCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Code Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->maxLength(50)
                            ->unique(ignoreRecord: true)
                            ->helperText('Unique code customers will enter'),
                        Textarea::make('description')
                            ->rows(2),
                    ]),
                Section::make('Discount Configuration')
                    ->columns(2)
                    ->schema([
                        Select::make('type')
                            ->options([
                                'percentage' => 'Percentage (%)',
                                'fixed_amount' => 'Fixed Amount (€)',
                            ])
                            ->default('percentage')
                            ->required()
                            ->reactive(),
                        TextInput::make('value')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->helperText(fn ($get): string => $get('type') === 'percentage' ? 'Percentage (1-100)' : 'Amount in cents'),
                        TextInput::make('min_order_amount')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('cents')
                            ->helperText('Leave empty for no minimum'),
                    ]),
                Section::make('Usage Limits')
                    ->columns(2)
                    ->schema([
                        TextInput::make('max_uses')
                            ->numeric()
                            ->minValue(1)
                            ->helperText('Leave empty for unlimited uses'),
                        Placeholder::make('used_count_display')
                            ->label('Used Count')
                            ->content(fn ($record) => $record?->used_count ?? 0),
                    ]),
                Section::make('Validity Period')
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('valid_from')
                            ->label('Valid From')
                            ->helperText('Leave empty for immediate validity'),
                        DateTimePicker::make('valid_until')
                            ->label('Valid Until')
                            ->helperText('Leave empty for no expiration'),
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
