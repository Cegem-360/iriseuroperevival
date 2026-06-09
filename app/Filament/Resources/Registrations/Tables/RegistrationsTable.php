<?php

declare(strict_types=1);

namespace App\Filament\Resources\Registrations\Tables;

use App\Exports\RegistrationsExport;
use App\Mail\BulkEmail;
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
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(['first_name'])
                    ->toggleable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->toggleable(),
                TextColumn::make('locale')
                    ->label('Email Language')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'hu' => 'success',
                        'en' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'hu' => 'Magyar',
                        'en' => 'English',
                        default => (string) $state,
                    })
                    ->toggleable(),
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
                    })
                    ->toggleable(),
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
                    })
                    ->toggleable(),
                TextColumn::make('country')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('ticket_type')
                    ->label('Pass')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'individual' => 'gray',
                        'team' => 'info',
                        'vip' => 'warning',
                        'volunteer' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'individual' => 'Standard',
                        'team' => 'Group',
                        'vip' => 'VIP',
                        'volunteer' => 'Volunteer',
                        default => $state ?? '-',
                    })
                    ->toggleable(),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('HUF', divideBy: 100)
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('paid_at')
                    ->label('Paid')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn (Registration $record): bool => $record->paid_at !== null)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('uuid')
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('first_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('last_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone')
                    ->icon('heroicon-m-phone')
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('city')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ticket_quantity')
                    ->label('Qty')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('citizenship')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('occupation')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('church_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('church_city')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pastor_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pastor_email')
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ministry_school_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_1_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_1_email')
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_1_status')
                    ->badge()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_1_response')
                    ->limit(40)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_2_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_2_email')
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_2_status')
                    ->badge()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_2_response')
                    ->limit(40)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stripe_session_id')
                    ->limit(20)
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stripe_payment_intent')
                    ->limit(20)
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stripe_customer_id')
                    ->limit(20)
                    ->copyable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('approved_by')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('rejected_by')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('rejection_reason')
                    ->limit(40)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('admin_notes')
                    ->limit(40)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user_id')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('invited_by')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('testimony')
                    ->limit(40)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('previous_service_description')
                    ->limit(40)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('languages')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('service_areas')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ministry_areas')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_born_again')
                    ->label('Born Again')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_spirit_filled')
                    ->label('Spirit Filled')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('attended_ministry_school')
                    ->label('Ministry School')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('has_served_before')
                    ->label('Served Before')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('wants_to_evangelize')
                    ->label('Evangelize')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('want_to_healing_room')
                    ->label('Healing Room')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('want_to_prophet_room')
                    ->label('Prophetic Room')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('approved_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('rejected_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_1_contacted_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_1_responded_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_2_contacted_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reference_2_responded_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('confirmation_email_sent_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->reorderableColumns()
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
                SelectFilter::make('ticket_type')
                    ->label('Ticket Type')
                    ->options([
                        'individual' => 'Standard',
                        'volunteer' => 'Volunteer',
                    ]),
                SelectFilter::make('country')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('send_email')
                    ->label('Send Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->visible(fn (): bool => self::canManageApplications())
                    ->modalHeading(fn (Registration $record) => "Send Email to {$record->full_name}")
                    ->form([
                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->placeholder('Email subject...'),
                        Textarea::make('body')
                            ->label('Message')
                            ->required()
                            ->rows(6)
                            ->placeholder('Write your message here...'),
                    ])
                    ->action(function (Registration $record, array $data): void {
                        Mail::to($record->email)->queue(
                            new BulkEmail($record, $data['subject'], $data['body']),
                        );

                        Notification::make()
                            ->title('Email Sent')
                            ->body("Email queued for {$record->full_name}")
                            ->success()
                            ->send();
                    }),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Registration')
                    ->modalDescription(fn (Registration $record): string => "Are you sure you want to approve this {$record->type} application?")
                    ->visible(fn (Registration $record): bool => self::canManageApplications() && in_array($record->type, ['ministry', 'volunteer']) && $record->status === 'pending_approval')
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
                            ->rows(18)
                            ->default(fn (Registration $record): string => str_replace(':name', $record->first_name, config('rejection.default'))),
                    ])
                    ->visible(fn (Registration $record): bool => self::canManageApplications() && in_array($record->type, ['ministry', 'volunteer']) && $record->status === 'pending_approval')
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
                            && $record->reference_1_status === 'pending')
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
                            && $record->reference_2_status === 'pending')
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
                    ->visible(fn (Registration $record): bool => self::canManageApplications() && $record->type === 'ministry'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('send_bulk_email')
                        ->label('Send Email')
                        ->icon('heroicon-o-envelope')
                        ->color('info')
                        ->visible(fn (): bool => self::canManageApplications())
                        ->modalHeading('Send Email to Selected Registrations')
                        ->form([
                            TextInput::make('subject')
                                ->label('Subject')
                                ->required()
                                ->placeholder('Email subject...'),
                            Textarea::make('body')
                                ->label('Message')
                                ->required()
                                ->rows(6)
                                ->placeholder('Write your message here. Use {first_name} to personalize.'),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $count = 0;
                            $records->each(function (Registration $record) use ($data, &$count): void {
                                Mail::to($record->email)->queue(
                                    new BulkEmail($record, $data['subject'], $data['body']),
                                );
                                $count++;
                            });

                            Notification::make()
                                ->title('Emails Sent')
                                ->body("Queued {$count} email(s) for delivery")
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('export_csv')
                        ->label('Export CSV')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('gray')
                        ->action(function (Collection $records): BinaryFileResponse {
                            $filename = 'registrations-' . now()->format('Y-m-d-His') . '.csv';

                            return Excel::download(
                                new RegistrationsExport($records),
                                $filename,
                                \Maatwebsite\Excel\Excel::CSV,
                            );
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('export_excel')
                        ->label('Export Excel')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (Collection $records): BinaryFileResponse {
                            $filename = 'registrations-' . now()->format('Y-m-d-His') . '.xlsx';

                            return Excel::download(
                                new RegistrationsExport($records),
                                $filename,
                                \Maatwebsite\Excel\Excel::XLSX,
                            );
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (): bool => self::canManageApplications())
                        ->action(function (Collection $records): void {
                            $count = 0;
                            $records->each(function (Registration $record) use (&$count): void {
                                if (in_array($record->type, ['ministry', 'volunteer']) && $record->status === 'pending_approval') {
                                    $record->approve(Auth::id());
                                    $count++;
                                }
                            });

                            Notification::make()
                                ->title('Registrations Approved')
                                ->body("Approved {$count} registration(s)")
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make()
                        ->visible(fn (): bool => Auth::user()?->isAdmin() ?? false),
                ]),
                Action::make('export_all_csv')
                    ->label('Export All (CSV)')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('gray')
                    ->visible(fn (): bool => Auth::user()?->isAdmin() ?? false)
                    ->action(function (): BinaryFileResponse {
                        $filename = 'all-registrations-' . now()->format('Y-m-d-His') . '.csv';

                        return Excel::download(
                            new RegistrationsExport(),
                            $filename,
                            \Maatwebsite\Excel\Excel::CSV,
                        );
                    }),
                Action::make('export_all_excel')
                    ->label('Export All (Excel)')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->visible(fn (): bool => Auth::user()?->isAdmin() ?? false)
                    ->action(function (): BinaryFileResponse {
                        $filename = 'all-registrations-' . now()->format('Y-m-d-His') . '.xlsx';

                        return Excel::download(
                            new RegistrationsExport(),
                            $filename,
                            \Maatwebsite\Excel\Excel::XLSX,
                        );
                    }),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }

    /**
     * Determine if the authenticated user may approve or reject applications.
     */
    protected static function canManageApplications(): bool
    {
        return Auth::user()?->role?->canManageApplications() ?? false;
    }
}
