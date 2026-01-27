<?php

declare(strict_types=1);

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Phone')
                            ->tel()
                            ->maxLength(30),
                        TextInput::make('country')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('city')
                            ->required()
                            ->maxLength(100),
                    ])
                    ->columns(2),

                Section::make('Registration Details')
                    ->schema([
                        Select::make('type')
                            ->label('Registration Type')
                            ->options([
                                'attendee' => 'Attendee',
                                'ministry' => 'Ministry Team',
                                'volunteer' => 'Volunteer',
                            ])
                            ->required()
                            ->default('attendee'),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending_payment' => 'Pending Payment',
                                'pending_approval' => 'Pending Approval',
                                'approved' => 'Approved',
                                'paid' => 'Paid',
                                'rejected' => 'Rejected',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('pending_payment'),
                        Select::make('ticket_type')
                            ->label('Ticket Type')
                            ->options([
                                'individual' => 'Individual',
                                'team' => 'Team',
                                'volunteer' => 'Volunteer',
                            ]),
                        TextInput::make('ticket_quantity')
                            ->label('Quantity')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                        TextInput::make('amount')
                            ->label('Amount (cents)')
                            ->numeric()
                            ->prefix('€')
                            ->helperText('Amount in cents (e.g., 4900 = €49.00)'),
                    ])
                    ->columns(2),

                Section::make('Ministry Team Details')
                    ->schema([
                        TextInput::make('citizenship')
                            ->maxLength(100),
                        Textarea::make('languages')
                            ->label('Languages')
                            ->helperText('Enter languages as JSON array'),
                        TextInput::make('occupation')
                            ->maxLength(255),
                        TextInput::make('church_name')
                            ->label('Church Name')
                            ->maxLength(255),
                        TextInput::make('church_city')
                            ->label('Church City')
                            ->maxLength(100),
                        TextInput::make('pastor_name')
                            ->label('Pastor Name')
                            ->maxLength(200),
                        TextInput::make('pastor_email')
                            ->label('Pastor Email')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),

                Section::make('Spiritual Background')
                    ->schema([
                        Toggle::make('is_born_again')
                            ->label('Born Again'),
                        Toggle::make('is_spirit_filled')
                            ->label('Spirit Filled'),
                        Textarea::make('testimony')
                            ->label('Testimony')
                            ->rows(5)
                            ->columnSpanFull(),
                        Toggle::make('attended_ministry_school')
                            ->label('Attended Ministry School'),
                        TextInput::make('ministry_school_name')
                            ->label('Ministry School Name')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),

                Section::make('References')
                    ->schema([
                        TextInput::make('reference_1_name')
                            ->label('Reference 1 Name')
                            ->maxLength(200),
                        TextInput::make('reference_1_email')
                            ->label('Reference 1 Email')
                            ->email()
                            ->maxLength(255),
                        Select::make('reference_1_status')
                            ->label('Reference 1 Status')
                            ->options([
                                'pending' => 'Pending',
                                'contacted' => 'Contacted',
                                'responded' => 'Responded',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ]),
                        DateTimePicker::make('reference_1_contacted_at')
                            ->label('Reference 1 Contacted At'),
                        Textarea::make('reference_1_response')
                            ->label('Reference 1 Response')
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('reference_2_name')
                            ->label('Reference 2 Name')
                            ->maxLength(200),
                        TextInput::make('reference_2_email')
                            ->label('Reference 2 Email')
                            ->email()
                            ->maxLength(255),
                        Select::make('reference_2_status')
                            ->label('Reference 2 Status')
                            ->options([
                                'pending' => 'Pending',
                                'contacted' => 'Contacted',
                                'responded' => 'Responded',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ]),
                        DateTimePicker::make('reference_2_contacted_at')
                            ->label('Reference 2 Contacted At'),
                        Textarea::make('reference_2_response')
                            ->label('Reference 2 Response')
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('invited_by')
                            ->label('Invited By')
                            ->maxLength(200)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),

                Section::make('Payment Information')
                    ->schema([
                        TextInput::make('stripe_session_id')
                            ->label('Stripe Session ID')
                            ->disabled(),
                        TextInput::make('stripe_payment_intent')
                            ->label('Stripe Payment Intent')
                            ->disabled(),
                        DateTimePicker::make('paid_at')
                            ->label('Paid At'),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),

                Section::make('Approval Information')
                    ->schema([
                        DateTimePicker::make('approved_at')
                            ->label('Approved At'),
                        TextInput::make('approved_by')
                            ->label('Approved By (User ID)')
                            ->numeric(),
                        DateTimePicker::make('rejected_at')
                            ->label('Rejected At'),
                        TextInput::make('rejected_by')
                            ->label('Rejected By (User ID)')
                            ->numeric(),
                        Textarea::make('rejection_reason')
                            ->label('Rejection Reason')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),

                Section::make('Admin Notes')
                    ->schema([
                        Textarea::make('admin_notes')
                            ->label('Notes')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
