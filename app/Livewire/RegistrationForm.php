<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\Country;
use App\Mail\MinistryApplicationReceived;
use App\Mail\VolunteerApplicationReceived;
use App\Models\Registration;
use App\Services\StripeService;
use Exception;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\View as SchemaView;
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
            'ticket_kind' => 'individual',
            'ticket_duration' => in_array($duration, ['1_day', '3_days']) ? $duration : '1_day',
            'ticket_price_option' => in_array($price, ['7500', '15000', 'custom']) ? $price : ($duration === '3_days' ? '15000' : '7500'),
            'group_duration' => '1_day',
            'group_size' => 5,
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
            $this->getStreetEvangelismStep(),
            $this->getVolunteerDetailsStep(),
            $this->getConfirmationStep(),
        ];
    }

    protected function getPersonalInfoStep(): Step
    {
        return Step::make(__('Personal Information'))
            ->description(__('Tell us about yourself'))
            ->icon('heroicon-o-user')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('first_name')
                            ->label(__('First Name'))
                            ->required()
                            ->maxLength(100)
                            ->placeholder(__('Your first name')),

                        TextInput::make('last_name')
                            ->label(__('Last Name'))
                            ->required()
                            ->maxLength(100)
                            ->placeholder(__('Your last name')),
                    ]),

                TextInput::make('email')
                    ->label(__('Email Address'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->placeholder(__('you@example.com')),

                TextInput::make('phone')
                    ->label(__('Phone Number'))
                    ->tel()
                    ->required()
                    ->maxLength(30)
                    ->placeholder(__('+36 30 123 4567')),

                Grid::make(2)
                    ->schema([
                        Select::make('country')
                            ->label(__('Country'))
                            ->required()
                            ->searchable()
                            ->options(Country::class)
                            ->optionsLimit(Country::count())
                            ->placeholder(__('Select country')),

                        TextInput::make('city')
                            ->label(__('City'))
                            ->required()
                            ->maxLength(100)
                            ->placeholder(__('Your city')),
                    ]),
            ]);
    }

    protected function getMinistryDetailsStep(): Step
    {
        return Step::make(__('Ministry Details'))
            ->description(__('Tell us about your background'))
            ->icon('heroicon-o-briefcase')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
            ->schema([
                TextInput::make('citizenship')
                    ->label(__('Citizenship'))
                    ->required()
                    ->maxLength(100)
                    ->placeholder(__('e.g. Hungarian, German, etc.')),

                CheckboxList::make('languages')
                    ->label(__('Languages You Speak'))
                    ->required()
                    ->options([
                        'English' => __('English'),
                        'Hungarian' => __('Hungarian'),
                        'German' => __('German'),
                        'Romanian' => __('Romanian'),
                        'Spanish' => __('Spanish'),
                        'French' => __('French'),
                        'Portuguese' => __('Portuguese'),
                        'Russian' => __('Russian'),
                        'Other' => __('Other'),
                    ])
                    ->columns(3)
                    ->gridDirection('row'),

                TextInput::make('occupation')
                    ->label(__('Occupation'))
                    ->required()
                    ->maxLength(255)
                    ->placeholder(__('Your current occupation')),
            ]);
    }

    protected function getChurchInfoStep(): Step
    {
        return Step::make(__('Church Information'))
            ->description(__('Tell us about your church'))
            ->icon('heroicon-o-building-library')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('church_name')
                            ->label(__('Church Name'))
                            ->required()
                            ->maxLength(255)
                            ->placeholder(__('Your home church name')),

                        TextInput::make('church_city')
                            ->label(__('Church City'))
                            ->required()
                            ->maxLength(100)
                            ->placeholder(__('City where your church is located')),
                    ]),

                Grid::make(2)
                    ->schema([
                        TextInput::make('pastor_name')
                            ->label(__('Senior Pastor\'s Name'))
                            ->required()
                            ->maxLength(200)
                            ->placeholder('Pastor\'s full name'),

                        TextInput::make('pastor_email')
                            ->label(__('Pastor\'s Email'))
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->placeholder(__('pastor@church.com')),
                    ]),
            ]);
    }

    protected function getTestimonyStep(): Step
    {
        return Step::make(__('Spiritual Background'))
            ->description(__('Share your testimony with us'))
            ->icon('heroicon-o-heart')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
            ->schema([
                Section::make(__('Spiritual Requirements'))
                    ->schema([
                        Checkbox::make('is_born_again')
                            ->label(__('I am a born-again believer'))
                            ->helperText(__('I have accepted Jesus Christ as my Lord and Savior'))
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'Ministry team members must be born again believers.',
                            ]),

                        Checkbox::make('is_spirit_filled')
                            ->label(__('I am Spirit-filled'))
                            ->helperText(__('I have received the baptism of the Holy Spirit'))
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'Ministry team members must be Spirit-filled.',
                            ]),
                    ]),

                Textarea::make('testimony')
                    ->label(__('Your Testimony'))
                    ->required()
                    ->minLength(100)
                    ->maxLength(3000)
                    ->rows(6)
                    ->placeholder(__('Please share your testimony and calling to ministry (minimum 100 characters)...'))
                    ->helperText(fn ($state) => strlen($state ?? '') . ' / ' . __(':n characters', ['n' => 3000])),

                Section::make(__('Ministry Training'))
                    ->schema([
                        Checkbox::make('attended_ministry_school')
                            ->label(__('I have attended a ministry/Bible school'))
                            ->live(),

                        TextInput::make('ministry_school_name')
                            ->label(__('School Name'))
                            ->maxLength(255)
                            ->placeholder(__('Name of the school'))
                            ->visible(fn ($get) => $get('attended_ministry_school')),
                    ]),

                Section::make(__('References'))
                    ->description(__('Please provide two references who can vouch for your character and ministry readiness.'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('reference_1_name')
                                    ->label(__('Reference 1 Name'))
                                    ->required()
                                    ->maxLength(200)
                                    ->placeholder(__('Full name')),

                                TextInput::make('reference_1_email')
                                    ->label(__('Reference 1 Email'))
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder(__('Email address')),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('reference_2_name')
                                    ->label(__('Reference 2 Name'))
                                    ->required()
                                    ->maxLength(200)
                                    ->placeholder(__('Full name')),

                                TextInput::make('reference_2_email')
                                    ->label(__('Reference 2 Email'))
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder(__('Email address')),
                            ]),
                    ]),

                Section::make(__('Invitation'))
                    ->collapsed()
                    ->schema([
                        TextInput::make('invited_by')
                            ->label(__('Who invited you? (Optional)'))
                            ->maxLength(200)
                            ->placeholder(__('Name of the person who invited you'))
                            ->helperText(__('If someone from our team invited you to apply, please enter their name.')),
                    ]),
            ]);
    }

    protected function getTicketSelectionStep(): Step
    {
        return Step::make(__('Select Your Tickets'))
            ->description(__('Choose the best option for you'))
            ->icon('heroicon-o-ticket')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'attendee')
            ->schema([
                Radio::make('ticket_kind')
                    ->label(__('Ticket Type'))
                    ->required()
                    ->options([
                        'individual' => __('Individual Ticket'),
                        'group' => __('Group Ticket (5+ people)'),
                    ])
                    ->descriptions([
                        'individual' => __('A single ticket for one person.'),
                        'group' => __('One purchase for a group of 5 or more people.'),
                    ])
                    ->default('individual')
                    ->live(),

                Radio::make('ticket_duration')
                    ->label(__('Access Duration'))
                    ->required()
                    ->visible(fn (Get $get): bool => ($get('ticket_kind') ?? 'individual') === 'individual')
                    ->options([
                        '1_day' => __('1 Day'),
                        '3_days' => __('3 Days'),
                    ])
                    ->default('1_day')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state): void {
                        $set('ticket_price_option', $state === '3_days' ? '15000' : '7500');
                        $set('ticket_custom_amount', null);

                        if ($state === '3_days') {
                            $set('individual_day', null);
                        }
                    }),

                Radio::make('individual_day')
                    ->label(__('Which day?'))
                    ->required()
                    ->visible(fn (Get $get): bool => ($get('ticket_kind') ?? 'individual') === 'individual' && ($get('ticket_duration') ?? '1_day') === '1_day')
                    ->options([
                        'friday' => __('Friday'),
                        'saturday' => __('Saturday'),
                        'sunday' => __('Sunday'),
                    ])
                    ->live(),

                Radio::make('ticket_price_option')
                    ->label(__('Choose Your Amount'))
                    ->required()
                    ->visible(fn (Get $get): bool => ($get('ticket_kind') ?? 'individual') === 'individual')
                    ->options(fn (Get $get): array => $get('ticket_duration') === '3_days'
                        ? [
                            '15000' => Number::currency(15000, 'HUF', app()->getLocale(), precision: 0) . ' (~' . Number::currency(15000 / config('services.currency.eur_huf_rate'), 'EUR', app()->getLocale(), precision: 0) . ')',
                            'custom' => __('Custom amount'),
                        ]
                        : [
                            '7500' => Number::currency(7500, 'HUF', app()->getLocale(), precision: 0) . ' (~' . Number::currency(7500 / config('services.currency.eur_huf_rate'), 'EUR', app()->getLocale(), precision: 0) . ')',
                            'custom' => __('Custom amount'),
                        ])
                    ->descriptions(fn (Get $get): array => $get('ticket_duration') === '3_days'
                        ? [
                            '15000' => __('This is the standard support price. If you would like to support the event with a higher amount, please select the custom option.'),
                            'custom' => __('Thank you for choosing to support the event with a custom amount!'),
                        ]
                        : [
                            '7500' => __('This is the standard support price. If you would like to support the event with a higher amount, please select the custom option.'),
                            'custom' => __('Thank you for choosing to support the event with a custom amount!'),
                        ])
                    ->default(fn (Get $get): string => $get('ticket_duration') === '3_days' ? '15000' : '7500')
                    ->live(),

                TextInput::make('ticket_custom_amount')
                    ->label(__('Custom Amount (HUF)'))
                    ->numeric()
                    ->required()
                    ->minValue(fn (Get $get): int => $get('ticket_duration') === '3_days' ? 15001 : 7501)
                    ->step(1)
                    ->placeholder(__('e.g. 20000'))
                    ->helperText(fn (Get $get): string => __('If you would like to support the event with an amount exceeding :amount.', ['amount' => Number::currency($get('ticket_duration') === '3_days' ? 15000 : 7500, 'HUF', app()->getLocale(), precision: 0)]))
                    ->visible(fn (Get $get): bool => ($get('ticket_kind') ?? 'individual') === 'individual' && $get('ticket_price_option') === 'custom')
                    ->live()
                    ->integer(),

                TextEntry::make('ticket_custom_amount_eur')
                    ->label('')
                    ->state(fn (Get $get): string => is_numeric($get('ticket_custom_amount'))
                        ? '≈ ' . Number::currency((int) $get('ticket_custom_amount') / config('services.currency.eur_huf_rate'), 'EUR', app()->getLocale())
                        : '')
                    ->visible(fn (Get $get): bool => ($get('ticket_kind') ?? 'individual') === 'individual' && $get('ticket_price_option') === 'custom' && is_numeric($get('ticket_custom_amount'))),

                Radio::make('group_duration')
                    ->label(__('Access Duration'))
                    ->required()
                    ->visible(fn (Get $get): bool => $get('ticket_kind') === 'group')
                    ->options([
                        '1_day' => __(':price / person', ['price' => Number::currency(7500, 'HUF', app()->getLocale(), precision: 0)]) . ' — ' . __('1 Day'),
                        '3_days' => __(':price / person', ['price' => Number::currency(15000, 'HUF', app()->getLocale(), precision: 0)]) . ' — ' . __('3 Days'),
                    ])
                    ->default('1_day')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state): void {
                        if ($state === '3_days') {
                            $set('group_day', null);
                        }
                    }),
                TextInput::make('group_size')
                    ->label(__('Number of People'))
                    ->numeric()
                    ->required()
                    ->visible(fn (Get $get): bool => $get('ticket_kind') === 'group')
                    ->minValue(5)
                    ->step(1)
                    ->default(5)
                    ->placeholder(__('e.g. 5'))
                    ->helperText(__('Minimum 5 people. Enter the total number of participants.'))
                    ->live()
                    ->integer(),
                Radio::make('group_day')
                    ->label(__('Which day?'))
                    ->required()
                    ->visible(fn (Get $get): bool => $get('ticket_kind') === 'group' && ($get('group_duration') ?? '1_day') === '1_day')
                    ->options([
                        'friday' => __('Friday'),
                        'saturday' => __('Saturday'),
                        'sunday' => __('Sunday'),
                    ])
                    ->live(),

                Section::make(__('Order Summary'))
                    ->schema([
                        SchemaView::make('livewire.registration-form.partials.order-summary'),
                    ]),
            ]);
    }

    protected function getStreetEvangelismStep(): Step
    {
        return Step::make(__('Street Evangelism'))
            ->description(__('Join us on the streets'))
            ->icon('heroicon-o-megaphone')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'attendee')
            ->schema([
                Radio::make('wants_to_evangelize')
                    ->label(__('Would you like to take part in street evangelism?'))
                    ->helperText(__('It will take place during the day, in the breaks, so you won\'t miss the main lectures.'))
                    ->required()
                    ->boolean()
                    ->default(false),
            ]);
    }

    protected function getVolunteerDetailsStep(): Step
    {
        return Step::make(__('Volunteer Details'))
            ->description(__('Tell us how you would like to serve'))
            ->icon('heroicon-o-hand-raised')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'volunteer')
            ->schema([
                CheckboxList::make('languages')
                    ->label(__('Languages You Speak'))
                    ->required()
                    ->options([
                        'English' => __('English'),
                        'Hungarian' => __('Hungarian'),
                        'German' => __('German'),
                        'Romanian' => __('Romanian'),
                        'Spanish' => __('Spanish'),
                        'French' => __('French'),
                        'Portuguese' => __('Portuguese'),
                        'Russian' => __('Russian'),
                        'Other' => __('Other'),
                    ])
                    ->columns(3)
                    ->gridDirection('row'),

                CheckboxList::make('service_areas')
                    ->label(__('Service Areas'))
                    ->helperText(__('Select the areas where you would like to serve (you can choose more than one)'))
                    ->required()
                    ->options([
                        'Childcare' => __('Childcare'),
                        'Ushers' => __('Ushers'),
                        'Registration' => __('Registration'),
                        'Merch' => __('Merch'),
                        'Hospitality' => __('Hospitality'),
                        'Tech & Media' => __('Tech & Media'),
                        'Translators' => __('Translators'),
                    ])
                    ->columns(2)
                    ->gridDirection('row'),

                Radio::make('has_served_before')
                    ->label(__('Have you served in the selected area before?'))
                    ->required()
                    ->boolean()
                    ->live(),

                TextInput::make('previous_service_description')
                    ->label(__('What area have you served in?'))
                    ->maxLength(500)
                    ->placeholder(__('Briefly describe your previous service experience'))
                    ->visible(fn (Get $get): bool => (bool) $get('has_served_before')),
            ]);
    }

    protected function getConfirmationStep(): Step
    {
        return Step::make(__('Confirmation'))
            ->description(__('Review and confirm your registration'))
            ->icon('heroicon-o-check-circle')
            ->schema([
                Section::make(__('Registration Summary'))
                    ->schema([
                        SchemaView::make('livewire.registration-form.partials.summary'),
                    ]),

                Section::make(__('Ministry Team Guidelines'))
                    ->description(__('Please read and accept the following guidelines'))
                    ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
                    ->schema([
                        SchemaView::make('livewire.registration-form.partials.ministry-guidelines'),

                        Checkbox::make('accepts_guidelines')
                            ->label(__('I accept the Ministry Team Guidelines'))
                            ->helperText(__('I understand and commit to the requirements above'))
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'You must accept the ministry team guidelines.',
                            ]),
                    ]),

                Checkbox::make('accepts_terms')
                    ->label(__('I accept the Terms & Conditions'))
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
            $isGroup = ($data['ticket_kind'] ?? 'individual') === 'group';

            if ($isGroup) {
                $groupDuration = $data['group_duration'] ?? '1_day';

                $registrationData['ticket_type'] = $groupDuration;
                $registrationData['ticket_quantity'] = max(5, (int) ($data['group_size'] ?? 5));
                $registrationData['is_group_ticket'] = true;
                $registrationData['ticket_day'] = $groupDuration === '1_day' ? ($data['group_day'] ?? null) : null;
            } else {
                $ticketDuration = $data['ticket_duration'] ?? '1_day';

                $registrationData['ticket_type'] = $ticketDuration;
                $registrationData['ticket_quantity'] = 1;
                $registrationData['is_group_ticket'] = false;
                $registrationData['ticket_day'] = $ticketDuration === '1_day' ? ($data['individual_day'] ?? null) : null;
            }

            $registrationData['amount'] = $this->calculateAmount($data);
            $registrationData['wants_to_evangelize'] = (bool) ($data['wants_to_evangelize'] ?? false);
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

        // Send confirmation email
        $this->sendConfirmationEmail($registration);

        return $registration;
    }

    protected function sendConfirmationEmail(Registration $registration): void
    {
        if ($registration->type === 'ministry') {
            Mail::to($registration->email)->queue(new MinistryApplicationReceived($registration));
        } elseif ($registration->type === 'volunteer') {
            Mail::to($registration->email)->queue(new VolunteerApplicationReceived($registration));
        }

        $registration->update(['confirmation_email_sent_at' => now()]);
    }

    /**
     * Per-person price (HUF) of a group ticket for the given access duration.
     */
    protected function groupPerPersonRate(string $groupDuration): int
    {
        return $groupDuration === '3_days' ? 15000 : 7500;
    }

    protected function calculateAmount(array $data): int
    {
        if (($data['ticket_kind'] ?? 'individual') === 'group') {
            $rate = $this->groupPerPersonRate($data['group_duration'] ?? '1_day');
            $size = max(5, (int) ($data['group_size'] ?? 5));

            return $size * $rate * 100;
        }

        $priceOption = (string) ($data['ticket_price_option'] ?? '7500');
        $ticketDuration = $data['ticket_duration'] ?? '1_day';

        if ($priceOption === 'custom') {
            $customAmount = (int) ($data['ticket_custom_amount'] ?? 0);
            $minAmount = $ticketDuration === '3_days' ? 15001 : 7501;

            if ($customAmount < $minAmount) {
                throw new Exception("Custom amount must be at least {$minAmount} Ft.");
            }

            return $customAmount * 100;
        }

        return match ($priceOption) {
            '15000' => 1500000,
            default => 750000,
        };
    }

    /**
     * Structured summary of the currently selected ticket, shared by the order
     * summary and confirmation partials.
     *
     * @return array{is_group: bool, duration: string, size: int, rate: int, day: ?string, amount_huf: int}
     */
    public function ticketSummary(): array
    {
        $data = $this->data ?? [];

        if (($data['ticket_kind'] ?? 'individual') === 'group') {
            $groupDuration = $data['group_duration'] ?? '1_day';
            $rate = $this->groupPerPersonRate($groupDuration);
            $size = max(5, (int) ($data['group_size'] ?? 5));

            return [
                'is_group' => true,
                'duration' => $groupDuration,
                'size' => $size,
                'rate' => $rate,
                'day' => $groupDuration === '1_day' ? ($data['group_day'] ?? null) : null,
                'amount_huf' => $size * $rate,
            ];
        }

        $priceOption = (string) ($data['ticket_price_option'] ?? '7500');
        $ticketDuration = $data['ticket_duration'] ?? '1_day';
        $minCustom = $ticketDuration === '3_days' ? 15000 : 7500;

        $amountHuf = match ($priceOption) {
            '15000' => 15000,
            'custom' => ($custom = (int) ($data['ticket_custom_amount'] ?? 0)) > $minCustom ? $custom : 0,
            default => 7500,
        };

        return [
            'is_group' => false,
            'duration' => $ticketDuration,
            'size' => 1,
            'rate' => $amountHuf,
            'day' => $ticketDuration === '1_day' ? ($data['individual_day'] ?? null) : null,
            'amount_huf' => $amountHuf,
        ];
    }

    public function getFormattedPrice(): string
    {
        return Number::currency($this->ticketSummary()['amount_huf'], 'HUF', app()->getLocale(), precision: 0);
    }

    public function render(): Factory|View
    {
        return view('livewire.registration-form');
    }
}
