<?php

declare(strict_types=1);

namespace App\Filament\Resources\Sponsors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SponsorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sponsor Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('website_url')
                            ->url()
                            ->maxLength(255),
                        Select::make('tier')
                            ->options([
                                'platinum' => 'Platinum',
                                'gold' => 'Gold',
                                'silver' => 'Silver',
                                'bronze' => 'Bronze',
                            ])
                            ->default('bronze')
                            ->required(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ]),
                Section::make('Logo')
                    ->schema([
                        FileUpload::make('logo_path')
                            ->image()
                            ->directory('sponsors')
                            ->imageEditor()
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
