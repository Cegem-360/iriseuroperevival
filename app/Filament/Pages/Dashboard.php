<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Filament\Widgets\PendingApprovalsWidget;
use App\Filament\Widgets\RegistrationStatsWidget;
use App\Filament\Widgets\RevenueChartWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Illuminate\Support\Facades\Auth;
use Override;

class Dashboard extends BaseDashboard
{
    /**
     * Administrators see the full dashboard. Ministry managers and coordinators
     * only see the pending ministry team approvals widget.
     *
     * @return array<int, class-string>
     */
    #[Override]
    public function getWidgets(): array
    {
        if (Auth::user()?->isLimitedToRegistrations()) {
            return [
                PendingApprovalsWidget::class,
            ];
        }

        return [
            AccountWidget::class,
            RegistrationStatsWidget::class,
            RevenueChartWidget::class,
            PendingApprovalsWidget::class,
        ];
    }
}
