<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Override;

class RegistrationStatsWidget extends StatsOverviewWidget
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
                ->descriptionIcon('heroicon-o-users')
                ->color('primary'),

            Stat::make('Attendees', $attendees)
                ->description('Paid attendees')
                ->descriptionIcon('heroicon-o-ticket')
                ->color('info'),

            Stat::make('Ministry Team', $ministryTeam)
                ->description('Applications received')
                ->descriptionIcon('heroicon-o-hand-raised')
                ->color('warning'),

            Stat::make('Volunteers', $volunteers)
                ->description('Volunteer registrations')
                ->descriptionIcon('heroicon-o-heart')
                ->color('success'),

            Stat::make('Pending Approvals', $pendingApprovals)
                ->description('Awaiting review')
                ->descriptionIcon('heroicon-o-clock')
                ->color($pendingApprovals > 0 ? 'warning' : 'success'),

            Stat::make('Total Revenue', '€' . number_format($totalRevenue / 100, 2))
                ->description($paidRegistrations . ' paid registrations')
                ->descriptionIcon('heroicon-o-currency-euro')
                ->color('success'),
        ];
    }
}
