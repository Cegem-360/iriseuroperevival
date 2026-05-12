<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Mail\MinistryApplicationReceived;
use App\Mail\RegistrationConfirmation;
use App\Models\Faq;
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
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.ministry')]
#[Title('Ministry Team - Europe Revival 2026')]
class MinistryTeam extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public string $type = 'ministry';

    public ?string $error = null;

    public ?array $data = [];

    public bool $processing = false;

    public function mount(string $type = 'ministry'): void
    {
        $this->type = 'ministry';

        $this->form->fill([
            'registration_type' => 'ministry',
            'ticket_type' => 'individual',
            'ticket_quantity' => 1,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('registration_type')->default('ministry'),
                Wizard::make($this->getWizardSteps())
                    ->submitAction(new HtmlString(view('livewire.registration-form.partials.submit-button', [
                        'type' => 'ministry',
                    ])->render())),
            ])
            ->statePath('data');
    }

    protected function getWizardSteps(): array
    {
        // Page is dedicated to Ministry Team applicants — no registration-type step,
        // no ticket/volunteer steps. Wizard goes straight from Personal Info to Confirmation.
        return [
            $this->getPersonalInfoStep(),
            $this->getMinistryDetailsStep(),
            $this->getChurchInfoStep(),
            $this->getTestimonyStep(),
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
                            ->options([
                                'Hungary' => __('Hungary'),
                                'Germany' => __('Germany'),
                                'Austria' => __('Austria'),
                                'Romania' => __('Romania'),
                                'Slovakia' => __('Slovakia'),
                                'Czech Republic' => __('Czech Republic'),
                                'Poland' => __('Poland'),
                                'United Kingdom' => __('United Kingdom'),
                                'United States' => __('United States'),
                                'Other' => __('Other'),
                            ])
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
                    ->label(__('Nationality'))
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
                CheckboxList::make('ministry_areas')
                    ->helperText(__('You can select multiple ministry areas!'))
                    ->options([
                        'evangalism_team_leader' => __('Evangelism Team Leader'),
                        'healing_room' => __('Healing Rooms'),
                        'prophetic_room' => __('Prophetic Rooms'),
                        'prayer_team' => __('Prayer Team'),
                        'hospitality_team' => __('Hospitality Team'),
                    ])
                    ->required()
                    ->translateLabel()
                    ->label('Ministry areas'),
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
                    ->maxLength(3000)
                    ->rows(6)
                    ->placeholder(__('Share as much or as little as you like.'))
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
        $stripeService = app(StripeService::class);
        $prices = $stripeService->getAllPrices();
        $tierName = $stripeService->getTierName();

        return Step::make(__('Select Your Tickets'))
            ->description(__('Choose the best option for you'))
            ->icon('heroicon-o-ticket')
            ->visible(fn (Get $get): bool => $get('registration_type') === 'attendee')
            ->schema([
                Radio::make('ticket_type')
                    ->label(__('Ticket Type'))
                    ->required()
                    ->options([
                        'individual' => 'Standard Ticket - Single attendee registration',
                        'team' => 'Group Pass - 10+ attendees (Save 20%)',
                        'vip' => 'VIP Pass - Premium experience with exclusive benefits',
                    ])
                    ->descriptions([
                        'individual' => "{$tierName} Price: " . Number::currency($prices['individual'] / 100, 'HUF', app()->getLocale(), precision: 0) . '/person',
                        'team' => "{$tierName} Price: " . Number::currency($prices['team'] / 100, 'HUF', app()->getLocale(), precision: 0) . '/person (min. 10 people)',
                        'vip' => "{$tierName} Price: " . Number::currency($prices['vip'] / 100, 'HUF', app()->getLocale(), precision: 0) . '/person - Front row seating, VIP lounge access, meet & greet',
                    ])
                    ->default('individual')
                    ->live(),

                TextInput::make('ticket_quantity')
                    ->label(__('Number of Tickets'))
                    ->numeric()
                    ->required()
                    ->minValue(fn ($get) => $get('ticket_type') === 'team' ? 10 : 1)
                    ->maxValue(fn ($get) => $get('ticket_type') === 'vip' ? 10 : 50)
                    ->default(1)
                    ->live()
                    ->helperText(function ($get) {
                        $ticketType = $get('ticket_type');
                        $quantity = (int) ($get('ticket_quantity') ?? 1);

                        if ($ticketType === 'team' && $quantity < 10) {
                            return 'Group pass requires minimum 10 tickets to qualify for the discount.';
                        }

                        if ($ticketType === 'vip') {
                            return 'VIP passes are limited to maximum 10 per order.';
                        }
                    })
                    ->rules([
                        fn ($get) => function (string $attribute, $value, \Closure $fail) use ($get) {
                            if ($get('ticket_type') === 'team' && (int) $value < 10) {
                                $fail('Group pass requires minimum 10 tickets.');
                            }
                        },
                    ]),

                Section::make('Order Summary')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.order-summary'),
                    ]),
            ]);
    }

    protected function getVolunteerDetailsStep(): Step
    {
        return Step::make(__('Volunteer Details'))
            ->description(__('Tell us about your skills'))
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

                Section::make('Volunteer Pass')
                    ->description(__('As a volunteer, you receive a discounted conference pass.'))
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.volunteer-pricing'),
                    ]),
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
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.summary'),
                    ]),

                Section::make(__('Ministry Team Guidelines'))
                    ->description(__('Please read and accept the following guidelines'))
                    ->visible(fn (Get $get): bool => $get('registration_type') === 'ministry')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.ministry-guidelines'),

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

            // Attendees and volunteers go through Stripe payment
            if (in_array($this->type, ['attendee', 'volunteer'])) {
                $stripeService = app(StripeService::class);
                $checkoutUrl = $stripeService->createCheckoutSession($registration);

                return redirect($checkoutUrl);
            }

            // Ministry team doesn't pay - just submits application
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
            'status' => $this->type === 'ministry' ? 'pending_approval' : 'pending_payment',
        ];

        if ($this->type === 'attendee') {
            $registrationData['ticket_type'] = $data['ticket_type'];
            $registrationData['ticket_quantity'] = $data['ticket_quantity'];
            $registrationData['amount'] = $this->calculateAmount($data);
        }

        if ($this->type === 'volunteer') {
            $registrationData['ticket_type'] = 'volunteer';
            $registrationData['ticket_quantity'] = 1;
            $registrationData['amount'] = app(StripeService::class)->getVolunteerPrice();
        }

        if ($this->type === 'ministry') {
            $registrationData['citizenship'] = $data['citizenship'];
            $registrationData['languages'] = $data['languages'];
            $registrationData['occupation'] = $data['occupation'];
            $registrationData['ministry_areas'] = $data['ministry_areas'];
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
            Mail::to($registration->email)->queue(new RegistrationConfirmation($registration));
        }

        $registration->update(['confirmation_email_sent_at' => now()]);
    }

    protected function calculateAmount(array $data): int
    {
        $stripeService = app(StripeService::class);
        $tier = $stripeService->getCurrentPricingTier();
        $pricePerTicket = $stripeService->getTicketPrice($data['ticket_type'], $tier);

        return (int) ($pricePerTicket * (int) $data['ticket_quantity']);
    }

    public function getFormattedPrice(): string
    {
        $data = $this->data ?? [];
        $ticketType = $data['ticket_type'] ?? 'individual';
        $quantity = (int) ($data['ticket_quantity'] ?? 1);

        $stripeService = app(StripeService::class);
        $pricePerTicket = $stripeService->getTicketPrice($ticketType, $stripeService->getCurrentPricingTier());

        return Number::currency(($pricePerTicket * $quantity) / 100, 'HUF', app()->getLocale(), precision: 0);
    }

    #[Computed]
    public function faqs(): Collection
    {
        return Faq::query()
            ->published()
            ->ofCategory('ministry')
            ->ordered()
            ->get();
    }

    public function render(): View
    {
        return view('livewire.pages.ministry-team');
    }
}
