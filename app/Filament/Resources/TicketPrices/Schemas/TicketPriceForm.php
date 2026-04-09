<?php

declare(strict_types=1);

namespace App\Filament\Resources\TicketPrices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketPriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ticket Price Details')
                    ->columns(2)
                    ->schema([
                        Select::make('ticket_type')
                            ->options([
                                'individual' => 'Individual',
                                'team' => 'Team',
                                'volunteer' => 'Volunteer',
                                'vip' => 'VIP',
                            ])
                            ->required(),
                        Select::make('pricing_tier')
                            ->options([
                                'early' => 'Early Bird',
                                'regular' => 'Regular',
                                'late' => 'Late Registration',
                            ])
                            ->required(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->suffix('Ft')
                            ->minValue(0)
                            ->formatStateUsing(fn ($state) => $state ? $state / 100 : null)
                            ->dehydrateStateUsing(fn ($state) => $state ? $state * 100 : null),
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Section::make('Status')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ]),
            ]);
    }
}
