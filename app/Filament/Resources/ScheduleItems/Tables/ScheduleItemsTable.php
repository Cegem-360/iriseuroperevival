<?php

declare(strict_types=1);

namespace App\Filament\Resources\ScheduleItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ScheduleItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day')
                    ->date('D, M j')
                    ->sortable(),
                TextColumn::make('start_time')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('end_time')
                    ->time('H:i'),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'session' => 'info',
                        'worship' => 'success',
                        'break' => 'gray',
                        'meal' => 'warning',
                        'special' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('speaker.name')
                    ->label('Speaker')
                    ->toggleable(),
                TextColumn::make('location')
                    ->toggleable(),
            ])
            ->defaultSort('day')
            ->groups([
                'day',
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'session' => 'Session',
                        'worship' => 'Worship',
                        'break' => 'Break',
                        'meal' => 'Meal',
                        'special' => 'Special Event',
                    ]),
                Filter::make('has_speaker')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('speaker_id'))
                    ->label('Has Speaker'),
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
