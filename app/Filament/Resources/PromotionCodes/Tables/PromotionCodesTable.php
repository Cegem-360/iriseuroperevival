<?php

declare(strict_types=1);

namespace App\Filament\Resources\PromotionCodes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PromotionCodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->copyable()
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'percentage' => 'info',
                        'fixed_amount' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'percentage' => 'Percentage',
                        'fixed_amount' => 'Fixed',
                        default => $state,
                    }),
                TextColumn::make('value')
                    ->formatStateUsing(fn ($record) => $record->formatted_value)
                    ->sortable(),
                TextColumn::make('used_count')
                    ->label('Usage')
                    ->formatStateUsing(fn ($record): string => $record->max_uses
                        ? "{$record->used_count}/{$record->max_uses}"
                        : "{$record->used_count}/∞"),
                TextColumn::make('valid_until')
                    ->label('Expires')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->placeholder('Never'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
