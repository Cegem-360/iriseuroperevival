<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PendingApprovalsWidget extends TableWidget
{
    protected static ?string $heading = 'Pending Ministry Team Approvals';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Registration::query()
                    ->where('type', 'ministry')
                    ->where('status', 'pending_approval')
                    ->latest(),
            )
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('country')
                    ->searchable(),
                TextColumn::make('church_name')
                    ->label('Church')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('created_at')
                    ->label('Applied')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Registration $record): void {
                        $record->approve(Auth::id());

                        Notification::make()
                            ->title('Application Approved')
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('reason')
                            ->label('Rejection Reason')
                            ->required(),
                    ])
                    ->action(function (Registration $record, array $data): void {
                        $record->reject(Auth::id(), $data['reason']);

                        Notification::make()
                            ->title('Application Rejected')
                            ->success()
                            ->send();
                    }),
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Registration $record): string => route('filament.admin.resources.registrations.edit', $record)),
            ])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5)
            ->emptyStateHeading('No pending approvals')
            ->emptyStateDescription('All ministry team applications have been reviewed.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
