<?php

declare(strict_types=1);

namespace App\Filament\Resources\Workshops\Schemas;

use App\Models\Speaker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WorkshopForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->maxLength(255)
                            ->helperText('Leave empty to auto-generate from title'),
                        Select::make('speaker_id')
                            ->label('Workshop Leader')
                            ->options(Speaker::query()->pluck('name', 'id'))
                            ->searchable()
                            ->nullable(),
                        Select::make('difficulty_level')
                            ->options([
                                'all' => 'All Levels',
                                'beginner' => 'Beginner',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced',
                            ])
                            ->default('all')
                            ->required(),
                    ]),
                Section::make('Description')
                    ->schema([
                        Textarea::make('short_description')
                            ->rows(2)
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
                Section::make('Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('duration_minutes')
                            ->label('Duration (minutes)')
                            ->numeric()
                            ->default(120)
                            ->minValue(30)
                            ->maxValue(480),
                        TextInput::make('capacity')
                            ->numeric()
                            ->nullable()
                            ->minValue(1)
                            ->helperText('Leave empty for unlimited'),
                        TagsInput::make('benefits')
                            ->placeholder('Add benefit')
                            ->columnSpanFull(),
                        TagsInput::make('requirements')
                            ->placeholder('Add requirement')
                            ->columnSpanFull(),
                    ]),
                Section::make('Media')
                    ->schema([
                        FileUpload::make('image_path')
                            ->image()
                            ->directory('workshops')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),
                Section::make('Settings')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ]),
            ]);
    }
}
