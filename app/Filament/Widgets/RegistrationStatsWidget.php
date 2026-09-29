<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use Override;

final class RegistrationStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    #[Override]
    protected function getStats(): array
    {
        $totalRegistrations = Registration::query()->count();
        $attendees = Registration::query()->where('type', 'attendee')->count();
        $ministryTeam = Registration::query()->where('type', 'ministry')->count();
        $volunteers = Registration::query()->where('type', 'volunteer')->count();
        $pendingApprovals = Registration::query()->where('status', 'pending_approval')->count();
        $paidRegistrations = Registration::query()->whereNotNull('paid_at')->count();
        $totalRevenue = Registration::query()->whereNotNull('paid_at')->sum('amount');

        return [
            Stat::make('Total Registrations', $totalRegistrations)
                ->description('All registration types')
                ->descriptionIcon(Heroicon::OutlinedUsers)
                ->color('primary'),

            Stat::make('Attendees', $attendees)
                ->description('Paid attendees')
                ->descriptionIcon(Heroicon::OutlinedTicket)
                ->color('info'),

            Stat::make('Ministry Team', $ministryTeam)
                ->description('Applications received')
                ->descriptionIcon(Heroicon::OutlinedHandRaised)
                ->color('warning'),

            Stat::make('Volunteers', $volunteers)
                ->description('Volunteer registrations')
                ->descriptionIcon(Heroicon::OutlinedHeart)
                ->color('success'),

            Stat::make('Pending Approvals', $pendingApprovals)
                ->description('Awaiting review')
                ->descriptionIcon(Heroicon::OutlinedClock)
                ->color($pendingApprovals > 0 ? 'warning' : 'success'),

            Stat::make('Total Revenue', Number::currency($totalRevenue / 100, 'HUF', app()->getLocale(), precision: 0))
                ->description($paidRegistrations . ' paid registrations')
                ->descriptionIcon(Heroicon::OutlinedBanknotes)
                ->color('success'),
        ];
    }
}
