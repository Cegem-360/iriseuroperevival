<?php

declare(strict_types=1);

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Question & Answer')
                    ->columns(1)
                    ->schema([
                        Textarea::make('question')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),
                        RichEditor::make('answer')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Section::make('Settings')
                    ->columns(3)
                    ->schema([
                        Select::make('category')
                            ->options([
                                'general' => 'General',
                                'registration' => 'Registration',
                                'accommodation' => 'Accommodation',
                                'travel' => 'Travel',
                            ])
                            ->default('general')
                            ->required(),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                    ]),
            ]);
    }
}
