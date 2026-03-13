<?php

declare(strict_types=1);

namespace App\Filament\Resources\Registrations\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorkshopsRelationManager extends RelationManager
{
    protected static string $relationship = 'workshops';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->date('Y. m. d.')
                    ->sortable(),
                TextColumn::make('leader_name')
                    ->label('Leader'),
                TextColumn::make('capacity')
                    ->label('Capacity'),
                TextColumn::make('registrations_count')
                    ->label('Signups')
                    ->counts('registrations'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->recordActions([
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
