<?php

declare(strict_types=1);

namespace App\Filament\Resources\TicketPrices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class TicketPricesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ticket_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'individual' => 'info',
                        'team' => 'success',
                        'volunteer' => 'warning',
                        'vip' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('pricing_tier')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'early' => 'success',
                        'regular' => 'info',
                        'late' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('label')
                    ->searchable(),
                TextColumn::make('price')
                    ->formatStateUsing(fn ($state): string => Number::currency($state / 100, 'HUF', app()->getLocale(), precision: 0))
                    ->sortable(),
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
                SelectFilter::make('ticket_type')
                    ->options([
                        'individual' => 'Individual',
                        'team' => 'Team',
                        'volunteer' => 'Volunteer',
                        'vip' => 'VIP',
                    ]),
                SelectFilter::make('pricing_tier')
                    ->options([
                        'early' => 'Early Bird',
                        'regular' => 'Regular',
                        'late' => 'Late Registration',
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
