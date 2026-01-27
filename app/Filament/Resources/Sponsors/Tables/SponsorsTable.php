<?php

declare(strict_types=1);

namespace App\Filament\Resources\Sponsors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SponsorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')
                    ->label('Logo'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tier')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'platinum' => 'info',
                        'gold' => 'warning',
                        'silver' => 'gray',
                        'bronze' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('website_url')
                    ->url(fn ($record) => $record->website_url)
                    ->openUrlInNewTab()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('tier')
                    ->options([
                        'platinum' => 'Platinum',
                        'gold' => 'Gold',
                        'silver' => 'Silver',
                        'bronze' => 'Bronze',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
