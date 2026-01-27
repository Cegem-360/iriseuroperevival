<?php

declare(strict_types=1);

namespace App\Filament\Resources\ScheduleItems\Schemas;

use App\Models\Speaker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ScheduleItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Select::make('type')
                            ->options([
                                'session' => 'Session',
                                'worship' => 'Worship',
                                'break' => 'Break',
                                'meal' => 'Meal',
                                'special' => 'Special Event',
                            ])
                            ->default('session')
                            ->required(),
                        Select::make('speaker_id')
                            ->label('Speaker')
                            ->options(Speaker::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                    ]),
                Section::make('Time & Location')
                    ->columns(4)
                    ->schema([
                        DatePicker::make('day')
                            ->required()
                            ->native(false),
                        TimePicker::make('start_time')
                            ->required()
                            ->seconds(false),
                        TimePicker::make('end_time')
                            ->required()
                            ->seconds(false)
                            ->after('start_time'),
                        TextInput::make('location')
                            ->maxLength(255)
                            ->placeholder('e.g., Main Hall'),
                    ]),
            ]);
    }
}
