<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Mail\MinistryApplicationReceived;
use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use App\Models\Workshop;
use App\Services\StripeService;
use Carbon\Carbon;
use Exception;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Livewire\Component;

class RegistrationForm extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public string $type = 'attendee';

    public ?string $error = null;

    public ?array $data = [];

    public bool $processing = false;

    public function mount(string $type = 'attendee'): void
    {
        $this->type = $type;

        $duration = request()->query('duration', '1_day');
        $price = request()->query('price', '7500');
        $amount = request()->query('amount');

        $fill = [
            'registration_type' => $type,
            'ticket_duration' => in_array($duration, ['1_day', '3_days']) ? $duration : '1_day',
            'ticket_price_option' => in_array($price, ['7500', '15000', 'custom']) ? $price : ($duration === '3_days' ? '15000' : '7500'),
        ];

        if ($price === 'custom' && $amount && (int) $amount > 15000) {
            $fill['ticket_custom_amount'] = (int) $amount;
        }

        $this->form->fill($fill);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('registration_type'),
                Wizard::make($this->getWizardSteps())
                    ->submitAction(new HtmlString(view('livewire.registration-form.partials.submit-button', [
                        'type' => $this->data['registration_type'] ?? 'attendee',
                    ])->render())),
            ])
            ->statePath('data');
    }

    protected function getWizardSteps(): array
    {
        return [
            $this->getPersonalInfoStep(),
            $this->getMinistryDetailsStep(),
            $this->getChurchInfoStep(),
            $this->getTestimonyStep(),
            $this->getTicketSelectionStep(),
            $this->getWorkshopSelectionStep(),
            $this->getHealingAndPropheticRoomsStep(),
            $this->getEvangelismStep(),
            $this->getVolunteerDetailsStep(),
            $this->getConfirmationStep(),
        ];
    }

    protected function getPersonalInfoStep(): Step
    {
        return Step::make('Personal Information')
            ->description('Tell us about yourself')
            ->icon('heroicon-o-user')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Your first name'),

                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Your last name'),
                    ]),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->placeholder('you@example.com'),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required()
                    ->maxLength(30)
                    ->placeholder('+36 30 123 4567'),

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
                            ])
                            ->placeholder('Select country'),

                        TextInput::make('city')
                            ->label('City')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Your city'),
                    ]),
            ]);
    }

    protected function getMinistryDetailsStep(): Step
    {
        return Step::make('Ministry Details')
            ->description('Tell us about your background')
            ->icon('heroicon-o-briefcase')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
            ->schema([
                TextInput::make('citizenship')
                    ->label('Citizenship')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('e.g. Hungarian, German, etc.'),

                CheckboxList::make('languages')
                    ->label('Languages You Speak')
                    ->required()
                    ->options([
                        'English' => 'English',
                        'Hungarian' => 'Hungarian',
                        'German' => 'German',
                        'Romanian' => 'Romanian',
                        'Spanish' => 'Spanish',
                        'French' => 'French',
                        'Portuguese' => 'Portuguese',
                        'Russian' => 'Russian',
                        'Other' => 'Other',
                    ])
                    ->columns(3)
                    ->gridDirection('row'),

                TextInput::make('occupation')
                    ->label('Occupation')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Your current occupation'),
            ]);
    }

    protected function getChurchInfoStep(): Step
    {
        return Step::make('Church Information')
            ->description('Tell us about your church')
            ->icon('heroicon-o-building-library')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('church_name')
                            ->label('Church Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Your home church name'),

                        TextInput::make('church_city')
                            ->label('Church City')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('City where your church is located'),
                    ]),

                Grid::make(2)
                    ->schema([
                        TextInput::make('pastor_name')
                            ->label('Senior Pastor\'s Name')
                            ->required()
                            ->maxLength(200)
                            ->placeholder('Pastor\'s full name'),

                        TextInput::make('pastor_email')
                            ->label('Pastor\'s Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('pastor@church.com'),
                    ]),
            ]);
    }

    protected function getTestimonyStep(): Step
    {
        return Step::make('Spiritual Background')
            ->description('Share your testimony with us')
            ->icon('heroicon-o-heart')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
            ->schema([
                Section::make('Spiritual Requirements')
                    ->schema([
                        Checkbox::make('is_born_again')
                            ->label('I am a born-again believer')
                            ->helperText('I have accepted Jesus Christ as my Lord and Savior')
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'Ministry team members must be born again believers.',
                            ]),

                        Checkbox::make('is_spirit_filled')
                            ->label('I am Spirit-filled')
                            ->helperText('I have received the baptism of the Holy Spirit')
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'Ministry team members must be Spirit-filled.',
                            ]),
                    ]),

                Textarea::make('testimony')
                    ->label('Your Testimony')
                    ->required()
                    ->minLength(100)
                    ->maxLength(3000)
                    ->rows(6)
                    ->placeholder('Please share your testimony and calling to ministry (minimum 100 characters)...')
                    ->helperText(fn ($state) => strlen($state ?? '') . '/3000 characters'),

                Section::make('Ministry Training')
                    ->schema([
                        Checkbox::make('attended_ministry_school')
                            ->label('I have attended a ministry/Bible school')
                            ->live(),

                        TextInput::make('ministry_school_name')
                            ->label('School Name')
                            ->maxLength(255)
                            ->placeholder('Name of the school')
                            ->visible(fn ($get) => $get('attended_ministry_school')),
                    ]),

                Section::make('References')
                    ->description('Please provide two references who can vouch for your character and ministry readiness.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('reference_1_name')
                                    ->label('Reference 1 Name')
                                    ->required()
                                    ->maxLength(200)
                                    ->placeholder('Full name'),

                                TextInput::make('reference_1_email')
                                    ->label('Reference 1 Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Email address'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('reference_2_name')
                                    ->label('Reference 2 Name')
                                    ->required()
                                    ->maxLength(200)
                                    ->placeholder('Full name'),

                                TextInput::make('reference_2_email')
                                    ->label('Reference 2 Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Email address'),
                            ]),
                    ]),

                Section::make('Invitation')
                    ->collapsed()
                    ->schema([
                        TextInput::make('invited_by')
                            ->label('Who invited you? (Optional)')
                            ->maxLength(200)
                            ->placeholder('Name of the person who invited you')
                            ->helperText('If someone from our team invited you to apply, please enter their name.'),
                    ]),
            ]);
    }

    protected function getTicketSelectionStep(): Step
    {
        return Step::make('Select Your Tickets')
            ->description('Choose the best option for you')
            ->icon('heroicon-o-ticket')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'attendee')
            ->schema([
                Radio::make('ticket_duration')
                    ->label('Access Duration')
                    ->required()
                    ->options([
                        '1_day' => '1 Day',
                        '3_days' => '3 Days',
                    ])
                    ->default('1_day')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state): void {
                        $set('ticket_price_option', $state === '3_days' ? '15000' : '7500');
                        $set('ticket_custom_amount', null);
                    }),

                Radio::make('ticket_price_option')
                    ->label('Choose Your Amount')
                    ->required()
                    ->options(fn (Get $get): array => $get('ticket_duration') === '3_days'
                        ? [
                            '15000' => Number::currency(15000, 'HUF', app()->getLocale(), precision: 0),
                            'custom' => 'Custom amount (HUF 15,000)',
                        ]
                        : [
                            '7500' => Number::currency(7500, 'HUF', app()->getLocale(), precision: 0),
                            'custom' => 'Custom amount (HUF 15 000)',
                        ])

                    ->default(fn (Get $get): string => $get('ticket_duration') === '3_days' ? '15000' : '7500')
                    ->live(),

                TextInput::make('ticket_custom_amount')
                    ->label('Custom Amount (Ft)')
                    ->numeric()
                    ->required()
                    ->minValue(15001)
                    ->step(1)
                    ->placeholder('e.g. 20000')
                    ->helperText(__('If you would like to support the event with an amount exceeding :amount.', ['amount' => Number::currency(15000, 'HUF', app()->getLocale(), precision: 0)]))
                    ->visible(fn (Get $get): bool => $get('ticket_price_option') === 'custom')
                    ->live()
                    ->rules([
                        function () {
                            return function (string $_attribute, $value, \Closure $fail): void {
                                if (! is_numeric($value) || floor((float) $value) !== (float) $value) {
                                    $fail('Please enter a whole number.');
                                }
                            };
                        },
                    ]),

                Section::make('Order Summary')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.order-summary'),
                    ]),
            ]);
    }

    protected function getWorkshopSelectionStep(): Step
    {
        return Step::make('Workshop Selection')
            ->description('Choose your workshops')
            ->icon('heroicon-o-academic-cap')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'attendee')
            ->schema([
                Radio::make('selected_day')
                    ->label('Which day would you like to attend?')
                    ->required()
                    ->options(fn (): array => $this->getWorkshopDayOptions())
                    ->visible(fn (Get $get): bool => $get('ticket_duration') === '1_day')
                    ->live(),

                Select::make('workshop_day_1')
                    ->label(fn (): string => 'Workshop - ' . $this->getWorkshopDayLabel(0))
                    ->options(fn (Get $get): array => $this->getAvailableWorkshopOptions(0))
                    ->searchable()
                    ->placeholder('Select a workshop (optional)')
                    ->visible(fn (Get $get): bool => $get('ticket_duration') === '3_days'
                        || ($get('ticket_duration') === '1_day' && $get('selected_day') === 'day_1'))
                    ->live(),

                Select::make('workshop_day_2')
                    ->label(fn (): string => 'Workshop - ' . $this->getWorkshopDayLabel(1))
                    ->options(fn (Get $get): array => $this->getAvailableWorkshopOptions(1))
                    ->searchable()
                    ->placeholder('Select a workshop (optional)')
                    ->visible(fn (Get $get): bool => $get('ticket_duration') === '3_days'
                        || ($get('ticket_duration') === '1_day' && $get('selected_day') === 'day_2'))
                    ->live(),
            ]);
    }

    protected function getEvangelismStep(): Step
    {
        return Step::make('Street Evangelism')
            ->description('Would you like to participate?')
            ->icon('heroicon-o-megaphone')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'attendee')
            ->schema([
                Radio::make('wants_to_evangelize')
                    ->label('Would you like to participate in street evangelism? 14:30-17:00')
                    ->required()
                    ->boolean()
                    ->helperText('During the conference, we organize street evangelism outreach opportunities.'),
            ]);
    }

    protected function getHealingAndPropheticRoomsStep(): Step
    {
        return Step::make('Healing and Prophetic Rooms')
            ->description('Would you like to participate?')
            ->icon('heroicon-o-heart')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'attendee')
            ->schema([
                Radio::make('wants_to_healing_room')
                    ->label('Would you like to participate in the healing room? 14:30-18:00 (Duration 15 min.)')
                    ->required()
                    ->boolean()
                    ->helperText('Registration is not mandatory, but spaces are limited!'),
                Radio::make('wants_to_prophet_room')
                    ->label('Would you like to participate in the prophetic room? 14:30-18:00 (Duration 15 min.)')
                    ->required()
                    ->boolean()
                    ->helperText('Registration is not mandatory, but spaces are limited!'),
            ]);
    }

    /** @return array<string, string> */
    protected function getWorkshopDayOptions(): array
    {
        $dates = $this->getWorkshopDates();

        $options = [];
        foreach ($dates as $index => $date) {
            $options['day_' . ($index + 1)] = $date->format('Y. m. d. (l)');
        }

        return $options;
    }

    protected function getWorkshopDayLabel(int $dayIndex): string
    {
        $dates = $this->getWorkshopDates();

        return isset($dates[$dayIndex]) ? $dates[$dayIndex]->format('Y. m. d. (l)') : 'Day ' . ($dayIndex + 1);
    }

    /** @return array<int, Carbon> */
    protected function getWorkshopDates(): array
    {
        return Workshop::query()
            ->published()
            ->whereNotNull('date')
            ->selectRaw('DISTINCT date')
            ->orderBy('date')
            ->pluck('date')
            ->map(fn ($date) => Carbon::parse($date))
            ->values()
            ->all();
    }

    /** @return array<int|string, string> */
    protected function getAvailableWorkshopOptions(int $dayIndex): array
    {
        $dates = $this->getWorkshopDates();

        if (! isset($dates[$dayIndex])) {
            return [];
        }

        return Workshop::query()
            ->published()
            ->whereDate('date', $dates[$dayIndex])
            ->withCount('registrations')
            ->get()
            ->filter(function (Workshop $workshop): bool {
                $maxAllowed = (int) ceil(($workshop->capacity ?? 0) * 1.1);

                return $workshop->capacity === null || $workshop->registrations_count < $maxAllowed;
            })
            ->mapWithKeys(fn (Workshop $workshop): array => [
                $workshop->id => $workshop->title . ($workshop->capacity
                    ? ' (' . ($workshop->capacity - $workshop->registrations_count) . ' spots left)'
                    : ''),
            ])
            ->all();
    }

    protected function getVolunteerDetailsStep(): Step
    {
        return Step::make('Volunteer Details')
            ->description('Tell us how you would like to serve')
            ->icon('heroicon-o-hand-raised')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'volunteer')
            ->schema([
                CheckboxList::make('languages')
                    ->label('Languages You Speak')
                    ->required()
                    ->options([
                        'English' => 'English',
                        'Hungarian' => 'Hungarian',
                        'German' => 'German',
                        'Romanian' => 'Romanian',
                        'Spanish' => 'Spanish',
                        'French' => 'French',
                        'Portuguese' => 'Portuguese',
                        'Russian' => 'Russian',
                        'Other' => 'Other',
                    ])
                    ->columns(3)
                    ->gridDirection('row'),

                CheckboxList::make('service_areas')
                    ->label('Service Areas')
                    ->helperText('Select the areas where you would like to serve (you can choose more than one)')
                    ->required()
                    ->options([
                        'Childcare' => 'Childcare',
                        'Ushers' => 'Ushers',
                        'Registration' => 'Registration',
                        'Merch' => 'Merch',
                        'Hospitality' => 'Hospitality',
                        'Tech & Media' => 'Tech & Media',
                        'Street Evangelism' => 'Street Evangelism',
                        'Kids Ministry' => 'Kids Ministry',
                    ])
                    ->columns(2)
                    ->gridDirection('row'),

                Radio::make('has_served_before')
                    ->label('Have you served in the selected area before?')
                    ->required()
                    ->boolean()
                    ->live(),

                TextInput::make('previous_service_description')
                    ->label('What area have you served in?')
                    ->maxLength(500)
                    ->placeholder('Briefly describe your previous service experience')
                    ->visible(fn (Get $get): bool => (bool) $get('has_served_before')),
            ]);
    }

    protected function getConfirmationStep(): Step
    {
        return Step::make('Confirmation')
            ->description('Review and confirm your registration')
            ->icon('heroicon-o-check-circle')
            ->schema([
                Section::make('Registration Summary')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.summary'),
                    ]),

                Section::make('Ministry Team Guidelines')
                    ->description('Please read and accept the following guidelines')
                    ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.ministry-guidelines'),

                        Checkbox::make('accepts_guidelines')
                            ->label('I accept the Ministry Team Guidelines')
                            ->helperText('I understand and commit to the requirements above')
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'You must accept the ministry team guidelines.',
                            ]),
                    ]),

                Checkbox::make('accepts_terms')
                    ->label('I accept the Terms & Conditions')
                    ->helperText(new HtmlString(view('livewire.registration-form.partials.terms-links')->render()))
                    ->accepted()
                    ->live()
                    ->validationMessages([
                        'accepted' => 'You must accept the terms and conditions.',
                    ]),
            ]);
    }

    public function submit()
    {
        $data = $this->form->getState();
        $this->type = $data['registration_type'];
        $this->processing = true;
        $this->error = null;

        try {
            $registration = $this->createRegistration($data);

            // Attendees go through Stripe payment
            if ($this->type === 'attendee') {
                $stripeService = app(StripeService::class);
                $checkoutUrl = $stripeService->createCheckoutSession($registration);

                return redirect($checkoutUrl);
            }

            // Volunteers and ministry team submit applications for approval
            Notification::make()
                ->title('Application Submitted!')
                ->success()
                ->send();

            return to_route('register.success', ['uuid' => $registration->uuid]);
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

    protected function createRegistration(array $data): Registration
    {
        $registrationData = [
            'uuid' => Str::uuid(),
            'type' => $this->type,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'city' => $data['city'],
            'status' => in_array($this->type, ['ministry', 'volunteer']) ? 'pending_approval' : 'pending_payment',
        ];

        if ($this->type === 'attendee') {
            $registrationData['ticket_type'] = $data['ticket_duration'];
            $registrationData['ticket_quantity'] = 1;
            $registrationData['amount'] = $this->calculateAmount($data);
            $registrationData['wants_to_evangelize'] = $data['wants_to_evangelize'] ?? false;
        }

        if ($this->type === 'volunteer') {
            $registrationData['service_areas'] = $data['service_areas'] ?? [];
            $registrationData['has_served_before'] = $data['has_served_before'] ?? false;
            $registrationData['previous_service_description'] = $data['previous_service_description'] ?? null;
        }

        if ($this->type === 'ministry') {
            $registrationData['citizenship'] = $data['citizenship'];
            $registrationData['languages'] = $data['languages'];
            $registrationData['occupation'] = $data['occupation'];
            $registrationData['church_name'] = $data['church_name'];
            $registrationData['church_city'] = $data['church_city'];
            $registrationData['pastor_name'] = $data['pastor_name'];
            $registrationData['pastor_email'] = $data['pastor_email'];
            $registrationData['is_born_again'] = $data['is_born_again'] ?? false;
            $registrationData['is_spirit_filled'] = $data['is_spirit_filled'] ?? false;
            $registrationData['testimony'] = $data['testimony'];
            $registrationData['attended_ministry_school'] = $data['attended_ministry_school'] ?? false;
            $registrationData['ministry_school_name'] = $data['ministry_school_name'] ?? null;
            $registrationData['reference_1_name'] = $data['reference_1_name'];
            $registrationData['reference_1_email'] = $data['reference_1_email'];
            $registrationData['reference_2_name'] = $data['reference_2_name'];
            $registrationData['reference_2_email'] = $data['reference_2_email'];
            $registrationData['invited_by'] = $data['invited_by'] ?? null;
            $registrationData['reference_1_status'] = 'pending';
            $registrationData['reference_2_status'] = 'pending';
        }

        if ($this->type === 'volunteer') {
            $registrationData['languages'] = $data['languages'];
        }

        $registration = Registration::query()->create($registrationData);

        // Attach selected workshops
        if ($this->type === 'attendee') {
            $workshopIds = array_filter([
                $data['workshop_day_1'] ?? null,
                $data['workshop_day_2'] ?? null,
            ]);

            if (! empty($workshopIds)) {
                $registration->workshops()->attach($workshopIds);
            }
        }

        // Send confirmation email
        $this->sendConfirmationEmail($registration);

        return $registration;
    }

    protected function sendConfirmationEmail(Registration $registration): void
    {
        if ($registration->type === 'ministry') {
            Mail::to($registration->email)->queue(new MinistryApplicationReceived($registration));
        } elseif ($registration->type === 'volunteer') {
            Mail::to($registration->email)->queue(new RegistrationConfirmation($registration));
        }

        $registration->update(['confirmation_email_sent_at' => now()]);
    }

    protected function calculateAmount(array $data): int
    {
        $priceOption = $data['ticket_price_option'] ?? '7500';

        if ($priceOption === 'custom') {
            $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);

            if ($customAmount < 15001) {
                throw new Exception('Custom amount must be at least 15,001 Ft.');
            }

            return $customAmount * 100;
        }

        return match ($priceOption) {
            '15000' => 1500000,
            default => 750000,
        };
    }

    public function getFormattedPrice(): string
    {
        $data = $this->data ?? [];
        $priceOption = $data['ticket_price_option'] ?? '7500';

        if ($priceOption === 'custom') {
            $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);
            $amountCents = $customAmount >= 15001 ? $customAmount * 100 : 0;
        } else {
            $amountCents = match ($priceOption) {
                '15000' => 1500000,
                default => 750000,
            };
        }

        return Number::currency($amountCents / 100, 'HUF', app()->getLocale(), precision: 0);
    }

    public function render(): Factory|View
    {
        return view('livewire.registration-form');
    }
}
