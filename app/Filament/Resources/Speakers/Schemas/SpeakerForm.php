<?php

declare(strict_types=1);

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SpeakerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->maxLength(255)
                            ->helperText('Leave empty to auto-generate from name'),
                        TextInput::make('title')
                            ->maxLength(255)
                            ->placeholder('e.g., Pastor, Worship Leader'),
                        TextInput::make('organization')
                            ->maxLength(255),
                        TextInput::make('country')
                            ->maxLength(255),
                        Select::make('type')
                            ->options([
                                'speaker' => 'Speaker',
                                'workshop_leader' => 'Workshop leader',
                                'worship_leader' => 'Worship leader',
                                'host' => 'Host',
                            ])
                            ->default('speaker')
                            ->required(),
                    ]),
                Section::make('Bio & Photo')
                    ->columns(1)
                    ->schema([
                        Textarea::make('bio')
                            ->rows(5)
                            ->columnSpanFull(),
                        FileUpload::make('photo_path')
                            ->image()
                            ->disk('public')
                            ->directory('speakers')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),
                Section::make('Social Links')
                    ->collapsed()
                    ->schema([
                        KeyValue::make('social_links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL/Username')
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),
                Section::make('Settings')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured Speaker'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ]),
                Section::make('Translations')
                    ->description('Per-language overrides. Leave empty to fall back to the base fields above.')
                    ->collapsed()
                    ->schema([
                        Tabs::make('translations_tabs')
                            ->columnSpanFull()
                            ->tabs([
                                Tab::make('English')
                                    ->schema(self::translationFields('en')),
                                Tab::make('Magyar')
                                    ->schema(self::translationFields('hu')),
                                Tab::make('Deutsch')
                                    ->schema(self::translationFields('de')),
                            ]),
                    ]),
            ]);
    }

    /**
     * @return array<int, Component>
     */
    protected static function translationFields(string $locale): array
    {
        return [
            TextInput::make("translations.{$locale}.title")
                ->label('Title')
                ->maxLength(255),
            TextInput::make("translations.{$locale}.organization")
                ->label('Organization')
                ->maxLength(255),
            Textarea::make("translations.{$locale}.bio")
                ->label('Bio')
                ->rows(5),
        ];
    }
}
