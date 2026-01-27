<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\PromotionCode;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('customer_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->tel(),
                        Placeholder::make('uuid')
                            ->label('Order ID')
                            ->content(fn ($record) => $record?->uuid ?? 'Will be generated'),
                    ]),
                Section::make('Addresses')
                    ->columns(2)
                    ->schema([
                        Textarea::make('billing_address')
                            ->rows(3),
                        Textarea::make('shipping_address')
                            ->rows(3),
                    ]),
                Section::make('Order Details')
                    ->columns(3)
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'paid' => 'Paid',
                                'shipped' => 'Shipped',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                                'refunded' => 'Refunded',
                            ])
                            ->default('pending')
                            ->required(),
                        Select::make('promotion_code_id')
                            ->label('Promotion Code')
                            ->options(PromotionCode::query()->pluck('code', 'id'))
                            ->searchable()
                            ->preload(),
                        DateTimePicker::make('paid_at')
                            ->label('Paid At'),
                    ]),
                Section::make('Totals')
                    ->columns(3)
                    ->schema([
                        TextInput::make('subtotal')
                            ->numeric()
                            ->suffix('cents')
                            ->disabled(),
                        TextInput::make('discount')
                            ->numeric()
                            ->suffix('cents')
                            ->disabled(),
                        TextInput::make('total')
                            ->numeric()
                            ->suffix('cents')
                            ->disabled(),
                    ]),
                Section::make('Stripe Information')
                    ->collapsed()
                    ->columns(2)
                    ->schema([
                        TextInput::make('stripe_session_id')
                            ->disabled(),
                        TextInput::make('stripe_payment_intent')
                            ->disabled(),
                    ]),
                Section::make('Notes')
                    ->schema([
                        Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
