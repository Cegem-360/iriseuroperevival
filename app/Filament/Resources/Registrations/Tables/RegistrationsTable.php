<?php

declare(strict_types=1);

namespace App\Filament\Resources\Registrations\Tables;

use App\Mail\ReferenceRequest;
use App\Models\Registration;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(['first_name']),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'attendee' => 'info',
                        'ministry' => 'warning',
                        'volunteer' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'attendee' => 'Attendee',
                        'ministry' => 'Ministry Team',
                        'volunteer' => 'Volunteer',
                        default => $state,
                    }),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending_payment' => 'warning',
                        'pending_approval' => 'warning',
                        'approved' => 'success',
                        'paid' => 'success',
                        'rejected' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending_payment' => 'Pending Payment',
                        'pending_approval' => 'Pending Approval',
                        'approved' => 'Approved',
                        'paid' => 'Paid',
                        'rejected' => 'Rejected',
                        'cancelled' => 'Cancelled',
                        default => $state,
                    }),
                TextColumn::make('country')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('ticket_type')
                    ->label('Ticket')
                    ->formatStateUsing(fn (?string $state): string => $state ? ucfirst($state) : '-')
                    ->toggleable(),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('EUR', divideBy: 100)
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('paid_at')
                    ->label('Paid')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn (Registration $record): bool => $record->paid_at !== null),
                TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->label('Registration Type')
                    ->options([
                        'attendee' => 'Attendee',
                        'ministry' => 'Ministry Team',
                        'volunteer' => 'Volunteer',
                    ]),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending_payment' => 'Pending Payment',
                        'pending_approval' => 'Pending Approval',
                        'approved' => 'Approved',
                        'paid' => 'Paid',
                        'rejected' => 'Rejected',
                        'cancelled' => 'Cancelled',
                    ]),
                SelectFilter::make('country')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Registration')
                    ->modalDescription('Are you sure you want to approve this ministry team application?')
                    ->visible(fn (Registration $record): bool => $record->type === 'ministry' && $record->status === 'pending_approval')
                    ->action(function (Registration $record): void {
                        $record->approve(Auth::id());

                        Notification::make()
                            ->title('Registration Approved')
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Registration')
                    ->form([
                        Textarea::make('reason')
                            ->label('Rejection Reason')
                            ->required()
                            ->placeholder('Please provide a reason for rejection...'),
                    ])
                    ->visible(fn (Registration $record): bool => $record->type === 'ministry' && $record->status === 'pending_approval')
                    ->action(function (Registration $record, array $data): void {
                        $record->reject(Auth::id(), $data['reason']);

                        Notification::make()
                            ->title('Registration Rejected')
                            ->success()
                            ->send();
                    }),
                ActionGroup::make([
                    Action::make('contact_reference_1')
                        ->label('Contact Reference 1')
                        ->icon('heroicon-o-envelope')
                        ->color('info')
                        ->requiresConfirmation()
                        ->modalHeading('Contact Reference 1')
                        ->modalDescription(fn (Registration $record): string => "Send reference request email to {$record->reference_1_name} ({$record->reference_1_email})?")
                        ->visible(fn (Registration $record): bool => $record->type === 'ministry'
                            && $record->reference_1_email
                            && $record->reference_1_status !== 'contacted'
                            && $record->reference_1_status !== 'responded')
                        ->action(function (Registration $record): void {
                            Mail::to($record->reference_1_email)->queue(
                                new ReferenceRequest($record, 1, $record->reference_1_name),
                            );

                            $record->update([
                                'reference_1_status' => 'contacted',
                                'reference_1_contacted_at' => now(),
                            ]);

                            Notification::make()
                                ->title('Reference request sent')
                                ->body("Email sent to {$record->reference_1_name}")
                                ->success()
                                ->send();
                        }),
                    Action::make('contact_reference_2')
                        ->label('Contact Reference 2')
                        ->icon('heroicon-o-envelope')
                        ->color('info')
                        ->requiresConfirmation()
                        ->modalHeading('Contact Reference 2')
                        ->modalDescription(fn (Registration $record): string => "Send reference request email to {$record->reference_2_name} ({$record->reference_2_email})?")
                        ->visible(fn (Registration $record): bool => $record->type === 'ministry'
                            && $record->reference_2_email
                            && $record->reference_2_status !== 'contacted'
                            && $record->reference_2_status !== 'responded')
                        ->action(function (Registration $record): void {
                            Mail::to($record->reference_2_email)->queue(
                                new ReferenceRequest($record, 2, $record->reference_2_name),
                            );

                            $record->update([
                                'reference_2_status' => 'contacted',
                                'reference_2_contacted_at' => now(),
                            ]);

                            Notification::make()
                                ->title('Reference request sent')
                                ->body("Email sent to {$record->reference_2_name}")
                                ->success()
                                ->send();
                        }),
                    Action::make('contact_all_references')
                        ->label('Contact Both References')
                        ->icon('heroicon-o-envelope-open')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Contact Both References')
                        ->modalDescription('Send reference request emails to both references?')
                        ->visible(fn (Registration $record): bool => $record->type === 'ministry'
                            && $record->reference_1_email
                            && $record->reference_2_email
                            && ($record->reference_1_status === 'pending' || $record->reference_2_status === 'pending'))
                        ->action(function (Registration $record): void {
                            $contacted = 0;

                            if ($record->reference_1_status === 'pending' && $record->reference_1_email) {
                                Mail::to($record->reference_1_email)->queue(
                                    new ReferenceRequest($record, 1, $record->reference_1_name),
                                );
                                $record->reference_1_status = 'contacted';
                                $record->reference_1_contacted_at = now();
                                $contacted++;
                            }

                            if ($record->reference_2_status === 'pending' && $record->reference_2_email) {
                                Mail::to($record->reference_2_email)->queue(
                                    new ReferenceRequest($record, 2, $record->reference_2_name),
                                );
                                $record->reference_2_status = 'contacted';
                                $record->reference_2_contacted_at = now();
                                $contacted++;
                            }

                            $record->save();

                            Notification::make()
                                ->title('Reference requests sent')
                                ->body("Sent {$contacted} reference request(s)")
                                ->success()
                                ->send();
                        }),
                ])
                    ->label('References')
                    ->icon('heroicon-o-user-group')
                    ->visible(fn (Registration $record): bool => $record->type === 'ministry'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $records->each(function (Registration $record): void {
                                if ($record->type === 'ministry' && $record->status === 'pending_approval') {
                                    $record->approve(Auth::id());
                                }
                            });

                            Notification::make()
                                ->title('Selected registrations approved')
                                ->success()
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
