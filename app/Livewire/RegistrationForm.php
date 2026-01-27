<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Mail\MinistryApplicationReceived;
use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use App\Services\StripeService;
use Exception;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class RegistrationForm extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public string $type = 'attendee';

    public ?array $data = [];

    public bool $processing = false;

    public function mount(string $type = 'attendee'): void
    {
        $this->type = $type;

        $this->form->fill([
            'ticket_type' => 'individual',
            'ticket_quantity' => 1,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make($this->getWizardSteps())
                    ->submitAction(view('livewire.registration-form.partials.submit-button', [
                        'type' => $this->type,
                    ])->render()),
            ])
            ->statePath('data');
    }

    protected function getWizardSteps(): array
    {
        $steps = [
            $this->getPersonalInfoStep(),
        ];

        if ($this->type === 'ministry') {
            $steps[] = $this->getMinistryDetailsStep();
            $steps[] = $this->getChurchInfoStep();
            $steps[] = $this->getTestimonyStep();
        }

        if ($this->type === 'attendee') {
            $steps[] = $this->getTicketSelectionStep();
        }

        if ($this->type === 'volunteer') {
            $steps[] = $this->getVolunteerDetailsStep();
        }

        $steps[] = $this->getConfirmationStep();

        return $steps;
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
            ->schema([
                Radio::make('ticket_type')
                    ->label('Ticket Type')
                    ->required()
                    ->options([
                        'individual' => 'Individual - Single attendee registration',
                        'team' => 'Team Pass - 10+ attendees group discount (Save 20%)',
                    ])
                    ->descriptions([
                        'individual' => 'Early Bird Price: €49/person',
                        'team' => 'Early Bird Price: €39/person',
                    ])
                    ->default('individual')
                    ->live(),

                TextInput::make('ticket_quantity')
                    ->label('Number of Tickets')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->maxValue(50)
                    ->default(1)
                    ->live()
                    ->helperText(function ($get) {
                        if ($get('ticket_type') === 'team' && (int) ($get('ticket_quantity') ?? 1) < 10) {
                            return 'Team pass requires minimum 10 tickets';
                        }
                    }),

                Section::make('Order Summary')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.order-summary'),
                    ]),
            ]);
    }

    protected function getVolunteerDetailsStep(): Step
    {
        return Step::make('Volunteer Details')
            ->description('Tell us about your skills')
            ->icon('heroicon-o-hand-raised')
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

                Section::make('Volunteer Pass')
                    ->description('As a volunteer, you receive a discounted conference pass.')
                    ->schema([
                        \Filament\Schemas\Components\View::make('livewire.registration-form.partials.volunteer-pricing'),
                    ]),
            ]);
    }

    protected function getConfirmationStep(): Step
    {
        $schema = [
            Section::make('Registration Summary')
                ->schema([
                    \Filament\Schemas\Components\View::make('livewire.registration-form.partials.summary'),
                ]),
        ];

        if ($this->type === 'ministry') {
            $schema[] = Section::make('Ministry Team Guidelines')
                ->description('Please read and accept the following guidelines')
                ->schema([
                    \Filament\Schemas\Components\View::make('livewire.registration-form.partials.ministry-guidelines'),

                    Checkbox::make('accepts_guidelines')
                        ->label('I accept the Ministry Team Guidelines')
                        ->helperText('I understand and commit to the requirements above')
                        ->accepted()
                        ->validationMessages([
                            'accepted' => 'You must accept the ministry team guidelines.',
                        ]),
                ]);
        }

        $schema[] = Checkbox::make('accepts_terms')
            ->label('I accept the Terms & Conditions')
            ->helperText(view('livewire.registration-form.partials.terms-links')->render())
            ->accepted()
            ->validationMessages([
                'accepted' => 'You must accept the terms and conditions.',
            ]);

        return Step::make('Confirmation')
            ->description('Review and confirm your registration')
            ->icon('heroicon-o-check-circle')
            ->schema($schema);
    }

    public function submit()
    {
        $data = $this->form->getState();
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

        return $pricePerTicket * $data['ticket_quantity'];
    }

    public function getFormattedPrice(): string
    {
        $data = $this->data ?? [];
        $ticketType = $data['ticket_type'] ?? 'individual';
        $quantity = (int) ($data['ticket_quantity'] ?? 1);
        $pricePerTicket = $ticketType === 'individual' ? 4900 : 3900;

        return '€' . number_format(($pricePerTicket * $quantity) / 100, 2);
    }

    public function render(): Factory|View
    {
        return view('livewire.registration-form');
    }
}
