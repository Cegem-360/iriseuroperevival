<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Registration;
use App\Services\StripeService;
use Illuminate\Support\Str;

class RegistrationForm extends Component
{
    // Form Type: 'attendee', 'ministry', 'volunteer'
    public string $type = 'attendee';
    
    // Current Step
    public int $currentStep = 1;
    public int $totalSteps = 4;
    
    // Step 1: Personal Information
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $country = '';
    public string $city = '';
    
    // Step 2: Ministry Details (Ministry Team Only)
    public string $citizenship = '';
    public array $languages = [];
    public string $occupation = '';
    public string $church_name = '';
    public string $church_city = '';
    public string $pastor_name = '';
    public string $pastor_email = '';
    
    // Step 3: Testimony (Ministry Team Only)
    public bool $is_born_again = false;
    public bool $is_spirit_filled = false;
    public string $testimony = '';
    public bool $attended_ministry_school = false;
    public string $ministry_school_name = '';
    public string $reference_1_name = '';
    public string $reference_1_email = '';
    public string $reference_2_name = '';
    public string $reference_2_email = '';
    
    // Step 4: Ticket Selection (Attendees)
    public string $ticket_type = 'individual'; // 'individual' or 'team'
    public int $ticket_quantity = 1;
    public array $team_members = [];
    
    // Agreements
    public bool $accepts_guidelines = false;
    public bool $accepts_terms = false;
    
    // Processing
    public bool $processing = false;
    public ?string $error = null;
    
    protected $listeners = ['resetForm'];
    
    public function mount(string $type = 'attendee')
    {
        $this->type = $type;
        
        // Set total steps based on type
        $this->totalSteps = match($type) {
            'attendee' => 3,
            'ministry' => 5,
            'volunteer' => 3,
            default => 3,
        };
    }
    
    public function rules(): array
    {
        $rules = [
            // Step 1 - Always required
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
        ];
        
        // Ministry Team specific rules
        if ($this->type === 'ministry') {
            $rules = array_merge($rules, [
                'citizenship' => 'required|string|max:100',
                'languages' => 'required|array|min:1',
                'occupation' => 'required|string|max:255',
                'church_name' => 'required|string|max:255',
                'church_city' => 'required|string|max:100',
                'pastor_name' => 'required|string|max:200',
                'pastor_email' => 'required|email|max:255',
                'is_born_again' => 'accepted',
                'is_spirit_filled' => 'accepted',
                'testimony' => 'required|string|min:100|max:3000',
                'reference_1_name' => 'required|string|max:200',
                'reference_1_email' => 'required|email|max:255',
                'reference_2_name' => 'required|string|max:200',
                'reference_2_email' => 'required|email|max:255',
            ]);
        }
        
        // Ticket selection for attendees
        if ($this->type === 'attendee') {
            $rules = array_merge($rules, [
                'ticket_type' => 'required|in:individual,team',
                'ticket_quantity' => 'required|integer|min:1|max:50',
            ]);
        }
        
        // Terms acceptance
        $rules['accepts_terms'] = 'accepted';
        
        if ($this->type === 'ministry') {
            $rules['accepts_guidelines'] = 'accepted';
        }
        
        return $rules;
    }
    
    protected function messages(): array
    {
        return [
            'first_name.required' => 'Please enter your first name.',
            'last_name.required' => 'Please enter your last name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'is_born_again.accepted' => 'Ministry team members must be born again believers.',
            'is_spirit_filled.accepted' => 'Ministry team members must be Spirit-filled.',
            'testimony.required' => 'Please share your testimony.',
            'testimony.min' => 'Your testimony should be at least 100 characters.',
            'accepts_terms.accepted' => 'You must accept the terms and conditions.',
            'accepts_guidelines.accepted' => 'You must accept the ministry team guidelines.',
        ];
    }
    
    public function nextStep(): void
    {
        $this->validateCurrentStep();
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }
    
    public function previousStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }
    
    public function goToStep(int $step): void
    {
        if ($step >= 1 && $step <= $this->currentStep) {
            $this->currentStep = $step;
        }
    }
    
    protected function validateCurrentStep(): void
    {
        $stepRules = $this->getStepRules($this->currentStep);
        $this->validate($stepRules);
    }
    
    protected function getStepRules(int $step): array
    {
        return match($this->type) {
            'attendee' => $this->getAttendeeStepRules($step),
            'ministry' => $this->getMinistryStepRules($step),
            'volunteer' => $this->getVolunteerStepRules($step),
            default => [],
        };
    }
    
    protected function getAttendeeStepRules(int $step): array
    {
        return match($step) {
            1 => [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:30',
                'country' => 'required|string|max:100',
                'city' => 'required|string|max:100',
            ],
            2 => [
                'ticket_type' => 'required|in:individual,team',
                'ticket_quantity' => 'required|integer|min:1|max:50',
            ],
            3 => [
                'accepts_terms' => 'accepted',
            ],
            default => [],
        };
    }
    
    protected function getMinistryStepRules(int $step): array
    {
        return match($step) {
            1 => [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:30',
                'country' => 'required|string|max:100',
                'city' => 'required|string|max:100',
            ],
            2 => [
                'citizenship' => 'required|string|max:100',
                'languages' => 'required|array|min:1',
                'occupation' => 'required|string|max:255',
            ],
            3 => [
                'church_name' => 'required|string|max:255',
                'church_city' => 'required|string|max:100',
                'pastor_name' => 'required|string|max:200',
                'pastor_email' => 'required|email|max:255',
            ],
            4 => [
                'is_born_again' => 'accepted',
                'is_spirit_filled' => 'accepted',
                'testimony' => 'required|string|min:100|max:3000',
                'reference_1_name' => 'required|string|max:200',
                'reference_1_email' => 'required|email|max:255',
                'reference_2_name' => 'required|string|max:200',
                'reference_2_email' => 'required|email|max:255',
            ],
            5 => [
                'accepts_terms' => 'accepted',
                'accepts_guidelines' => 'accepted',
            ],
            default => [],
        };
    }
    
    protected function getVolunteerStepRules(int $step): array
    {
        return match($step) {
            1 => [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:30',
                'country' => 'required|string|max:100',
                'city' => 'required|string|max:100',
            ],
            2 => [
                'languages' => 'required|array|min:1',
            ],
            3 => [
                'accepts_terms' => 'accepted',
            ],
            default => [],
        };
    }
    
    public function submit()
    {
        $this->validate();
        $this->processing = true;
        $this->error = null;
        
        try {
            $registration = $this->createRegistration();
            
            if ($this->type === 'attendee') {
                // Redirect to Stripe Checkout
                $stripeService = app(StripeService::class);
                $checkoutUrl = $stripeService->createCheckoutSession($registration);
                
                return redirect($checkoutUrl);
            }
            
            // For ministry/volunteer - redirect to success page
            return redirect()->route('register.success', ['uuid' => $registration->uuid]);
            
        } catch (\Exception $e) {
            $this->error = 'An error occurred. Please try again or contact support.';
            $this->processing = false;
            
            report($e);
        }
    }
    
    protected function createRegistration(): Registration
    {
        $data = [
            'uuid' => Str::uuid(),
            'type' => $this->type,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'status' => $this->type === 'attendee' ? 'pending_payment' : 'pending_approval',
        ];
        
        // Attendee specific
        if ($this->type === 'attendee') {
            $data['ticket_type'] = $this->ticket_type;
            $data['ticket_quantity'] = $this->ticket_quantity;
            $data['amount'] = $this->calculateAmount();
        }
        
        // Ministry team specific
        if ($this->type === 'ministry') {
            $data['citizenship'] = $this->citizenship;
            $data['languages'] = $this->languages;
            $data['occupation'] = $this->occupation;
            $data['church_name'] = $this->church_name;
            $data['church_city'] = $this->church_city;
            $data['pastor_name'] = $this->pastor_name;
            $data['pastor_email'] = $this->pastor_email;
            $data['is_born_again'] = $this->is_born_again;
            $data['is_spirit_filled'] = $this->is_spirit_filled;
            $data['testimony'] = $this->testimony;
            $data['attended_ministry_school'] = $this->attended_ministry_school;
            $data['ministry_school_name'] = $this->ministry_school_name;
            $data['reference_1_name'] = $this->reference_1_name;
            $data['reference_1_email'] = $this->reference_1_email;
            $data['reference_2_name'] = $this->reference_2_name;
            $data['reference_2_email'] = $this->reference_2_email;
        }
        
        // Volunteer specific
        if ($this->type === 'volunteer') {
            $data['languages'] = $this->languages;
        }
        
        return Registration::create($data);
    }
    
    protected function calculateAmount(): int
    {
        $stripeService = app(StripeService::class);
        $tier = $stripeService->getCurrentPricingTier();
        $pricePerTicket = $stripeService->getTicketPrice($this->ticket_type, $tier);
        
        return $pricePerTicket * $this->ticket_quantity;
    }
    
    public function getProgressProperty(): int
    {
        return (int) (($this->currentStep / $this->totalSteps) * 100);
    }
    
    public function getFormattedPriceProperty(): string
    {
        $amount = $this->calculateAmount();
        return '€' . number_format($amount / 100, 2);
    }
    
    public function resetForm(): void
    {
        $this->reset();
        $this->currentStep = 1;
    }
    
    public function render()
    {
        return view('livewire.registration-form');
    }
}
