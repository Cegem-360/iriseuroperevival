<?php

declare(strict_types=1);

namespace App\Filament\Resources\Donations\Tables;

use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Query\Builder;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                TextColumn::make('amount_huf')
                    ->label('Amount')
                    ->numeric(thousandsSeparator: ' ')
                    ->suffix(' Ft')
                    ->sortable()
                    ->summarize(Sum::make()
                        ->label('Total paid')
                        ->query(fn (Builder $query): Builder => $query->where('status', 'paid'))
                        ->numeric(thousandsSeparator: ' ')
                        ->suffix(' Ft')),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('name')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('email')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('locale')
                    ->label('Lang')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('paid_at')
                    ->dateTime('Y-m-d H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'paid' => 'Paid',
                        'pending' => 'Pending',
                    ])
                    ->default('paid'),
            ]);
    }
}
