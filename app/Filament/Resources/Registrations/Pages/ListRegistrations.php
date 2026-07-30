<?php

declare(strict_types=1);

namespace App\Filament\Resources\Registrations\Pages;

use App\Filament\Resources\Registrations\RegistrationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListRegistrations extends ListRecords
{
    protected static string $resource = RegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /**
     * Tabs let staff jump straight to one registration type instead of
     * reaching for the type filter on every visit.
     *
     * @return array<string, Tab>
     */
    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('All')
                ->badge(fn (): int => static::countRegistrations()),
        ];

        if (! Auth::user()?->isLimitedToRegistrations()) {
            $tabs['attendees'] = Tab::make('Attendees')
                ->icon('heroicon-m-ticket')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('type', 'attendee'))
                ->badge(fn (): int => static::countRegistrations(['type' => 'attendee']));
        }

        $tabs['volunteers'] = Tab::make('Volunteers')
            ->icon('heroicon-m-hand-raised')
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('type', 'volunteer'))
            ->badge(fn (): int => static::countRegistrations(['type' => 'volunteer']));

        $tabs['ministry'] = Tab::make('Ministry Team')
            ->icon('heroicon-m-user-group')
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('type', 'ministry'))
            ->badge(fn (): int => static::countRegistrations(['type' => 'ministry']));

        $tabs['pending_approval'] = Tab::make('Needs Approval')
            ->icon('heroicon-m-clock')
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('status', 'pending_approval'))
            ->badge(fn (): int => static::countRegistrations(['status' => 'pending_approval']))
            ->badgeColor('warning');

        return $tabs;
    }

    /**
     * Count the registrations the current user may see, optionally narrowed
     * by column values.
     *
     * @param  array<string, string>  $conditions
     */
    protected static function countRegistrations(array $conditions = []): int
    {
        $query = RegistrationResource::getEloquentQuery();

        foreach ($conditions as $column => $value) {
            $query->where($column, $value);
        }

        return $query->count();
    }
}
