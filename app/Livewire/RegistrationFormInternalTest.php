<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Registration;
use App\Services\StripeService;
use Exception;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * Disposable Livewire component that runs the real attendee payment flow against
 * Stripe at a fixed low amount (config('internal_test.amount_huf'), default 175 Ft).
 *
 * Intentionally trimmed to personal info + confirmation — no ticket selection UI,
 * no ministry/volunteer branches. Every created registration is flagged with
 * is_test = true so it can be filtered out of dashboards and bulk-deleted later.
 *
 * Delete this file + the matching blade + route + migration to fully remove.
 */
class RegistrationFormInternalTest extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public bool $processing = false;

    public function mount(): void
    {
        $this->form->fill([
            'first_name' => 'Internal',
            'last_name' => 'Test',
            'country' => 'Hungary',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    $this->getPersonalInfoStep(),
                    $this->getConfirmationStep(),
                ])->submitAction(new HtmlString(view('livewire.registration-form-internal-test.submit-button')->render())),
            ])
            ->statePath('data');
    }

    protected function getPersonalInfoStep(): Step
    {
        return Step::make('Personal Information')
            ->description('Used for the Stripe customer record')
            ->icon('heroicon-o-user')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(100),
                    ]),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required()
                    ->maxLength(30),

                Grid::make(2)
                    ->schema([
                        Select::make('country')
                            ->label('Country')
                            ->required()
                            ->searchable()
                            ->options([
                                'Hungary' => 'Hungary',
                                'Germany' => 'Germany',
                                'Austria' => 'Austria',
                                'Romania' => 'Romania',
                                'Slovakia' => 'Slovakia',
                                'Czech Republic' => 'Czech Republic',
                                'Poland' => 'Poland',
                                'United Kingdom' => 'United Kingdom',
                                'United States' => 'United States',
                                'Other' => 'Other',
                            ]),

                        TextInput::make('city')
                            ->label('City')
                            ->required()
                            ->maxLength(100),
                    ]),
            ]);
    }

    protected function getConfirmationStep(): Step
    {
        return Step::make('Confirm & Pay')
            ->description('Live Stripe charge at the test amount')
            ->icon('heroicon-o-check-circle')
            ->schema([
                Section::make('Order Summary')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form-internal-test.summary'),
                    ]),

                Checkbox::make('accepts_terms')
                    ->label('I understand this is a live-payment internal test')
                    ->accepted()
                    ->live()
                    ->validationMessages([
                        'accepted' => 'You must confirm before proceeding.',
                    ]),
            ]);
    }

    public function submit()
    {
        $data = $this->form->getState();
        $this->processing = true;

        try {
            $registration = Registration::query()->create([
                'uuid' => Str::uuid(),
                'type' => 'attendee',
                'status' => 'pending_payment',
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'country' => $data['country'],
                'city' => $data['city'],
                'ticket_type' => '1_day',
                'ticket_quantity' => 1,
                'amount' => $this->getAmountCents(),
                'is_test' => true,
            ]);

            $checkoutUrl = app(StripeService::class)->createCheckoutSession($registration);

            return redirect($checkoutUrl);
        } catch (Exception $e) {
            $this->processing = false;

            Notification::make()
                ->title('Error')
                ->body('An error occurred. Please try again or contact support.')
                ->danger()
                ->send();

            report($e);
        }
    }

    public function getAmountCents(): int
    {
        return (int) config('internal_test.amount_huf') * 100;
    }

    public function getFormattedAmount(): string
    {
        return Number::currency((int) config('internal_test.amount_huf'), 'HUF', app()->getLocale(), precision: 0);
    }

    public function render(): Factory|View
    {
        return view('livewire.registration-form-internal-test');
    }
}
