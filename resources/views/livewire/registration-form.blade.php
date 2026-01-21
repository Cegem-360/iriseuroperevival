{{-- resources/views/livewire/registration-form.blade.php --}}
<div class="max-w-2xl mx-auto">
    {{-- Progress Bar --}}
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-white/60">Step {{ $currentStep }} of {{ $totalSteps }}</span>
            <span class="text-sm text-amber-400 font-medium">{{ $this->progress }}% Complete</span>
        </div>
        <div class="h-2 bg-stone-800 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500 rounded-full transition-all duration-500"
                 style="width: {{ $this->progress }}%"></div>
        </div>
    </div>

    {{-- Step Indicators --}}
    <div class="flex justify-center gap-2 mb-8">
        @for($i = 1; $i <= $totalSteps; $i++)
            <button wire:click="goToStep({{ $i }})"
                    @if($i > $currentStep) disabled @endif
                    class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-semibold transition-all
                           {{ $i === $currentStep 
                              ? 'bg-amber-500 text-stone-900' 
                              : ($i < $currentStep 
                                  ? 'bg-amber-500/20 text-amber-400 hover:bg-amber-500/30 cursor-pointer' 
                                  : 'bg-stone-800 text-white/40 cursor-not-allowed') }}">
                @if($i < $currentStep)
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                @else
                    {{ $i }}
                @endif
            </button>
        @endfor
    </div>

    {{-- Error Message --}}
    @if($error)
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 text-sm">
            {{ $error }}
        </div>
    @endif

    <form wire:submit="submit" class="space-y-6">
        {{-- ================================
            STEP 1: Personal Information
        ================================= --}}
        @if($currentStep === 1)
            <div class="space-y-6 animate-fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Personal Information</h2>
                    <p class="text-white/60">Tell us about yourself</p>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    {{-- First Name --}}
                    <div>
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" id="first_name" wire:model="first_name"
                               class="form-input @error('first_name') !border-red-500 @enderror"
                               placeholder="Your first name">
                        @error('first_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div>
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" id="last_name" wire:model="last_name"
                               class="form-input @error('last_name') !border-red-500 @enderror"
                               placeholder="Your last name">
                        @error('last_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="form-label">Email Address *</label>
                    <input type="email" id="email" wire:model="email"
                           class="form-input @error('email') !border-red-500 @enderror"
                           placeholder="you@example.com">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="form-label">Phone Number *</label>
                    <input type="tel" id="phone" wire:model="phone"
                           class="form-input @error('phone') !border-red-500 @enderror"
                           placeholder="+36 30 123 4567">
                    @error('phone')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    {{-- Country --}}
                    <div>
                        <label for="country" class="form-label">Country *</label>
                        <select id="country" wire:model="country"
                                class="form-select @error('country') !border-red-500 @enderror">
                            <option value="">Select country</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Germany">Germany</option>
                            <option value="Austria">Austria</option>
                            <option value="Romania">Romania</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Poland">Poland</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('country')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div>
                        <label for="city" class="form-label">City *</label>
                        <input type="text" id="city" wire:model="city"
                               class="form-input @error('city') !border-red-500 @enderror"
                               placeholder="Your city">
                        @error('city')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        {{-- ================================
            STEP 2: Ministry Details (Ministry Team Only)
        ================================= --}}
        @if($currentStep === 2 && $type === 'ministry')
            <div class="space-y-6 animate-fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Ministry Details</h2>
                    <p class="text-white/60">Tell us about your background</p>
                </div>

                {{-- Citizenship --}}
                <div>
                    <label for="citizenship" class="form-label">Citizenship *</label>
                    <input type="text" id="citizenship" wire:model="citizenship"
                           class="form-input @error('citizenship') !border-red-500 @enderror"
                           placeholder="e.g. Hungarian, German, etc.">
                    @error('citizenship')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Languages --}}
                <div>
                    <label class="form-label">Languages You Speak *</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(['English', 'Hungarian', 'German', 'Romanian', 'Spanish', 'French', 'Portuguese', 'Russian', 'Other'] as $lang)
                            <label class="flex items-center gap-3 p-3 bg-stone-900 border border-stone-700 rounded-lg cursor-pointer hover:border-amber-500/50 transition-colors">
                                <input type="checkbox" wire:model="languages" value="{{ $lang }}"
                                       class="form-checkbox">
                                <span class="text-white/80 text-sm">{{ $lang }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('languages')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Occupation --}}
                <div>
                    <label for="occupation" class="form-label">Occupation *</label>
                    <input type="text" id="occupation" wire:model="occupation"
                           class="form-input @error('occupation') !border-red-500 @enderror"
                           placeholder="Your current occupation">
                    @error('occupation')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endif

        {{-- ================================
            STEP 2: Ticket Selection (Attendees)
        ================================= --}}
        @if($currentStep === 2 && $type === 'attendee')
            <div class="space-y-6 animate-fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Select Your Tickets</h2>
                    <p class="text-white/60">Choose the best option for you</p>
                </div>

                {{-- Ticket Type Selection --}}
                <div class="grid md:grid-cols-2 gap-4">
                    {{-- Individual --}}
                    <label class="block cursor-pointer">
                        <input type="radio" wire:model.live="ticket_type" value="individual" class="sr-only peer">
                        <div class="p-6 bg-stone-900 border-2 border-stone-700 rounded-2xl 
                                    peer-checked:border-amber-500 peer-checked:bg-amber-500/10 transition-all">
                            <h3 class="text-lg font-bold text-white mb-2">Individual</h3>
                            <p class="text-white/60 text-sm mb-4">Single attendee registration</p>
                            <p class="text-3xl font-bold text-amber-400">€49<span class="text-white/40 text-base font-normal">/person</span></p>
                            <p class="text-white/40 text-xs mt-1">Early Bird Price</p>
                        </div>
                    </label>

                    {{-- Team --}}
                    <label class="block cursor-pointer">
                        <input type="radio" wire:model.live="ticket_type" value="team" class="sr-only peer">
                        <div class="p-6 bg-stone-900 border-2 border-stone-700 rounded-2xl 
                                    peer-checked:border-amber-500 peer-checked:bg-amber-500/10 transition-all relative">
                            <span class="absolute -top-3 -right-2 px-3 py-1 bg-amber-500 text-stone-900 text-xs font-bold rounded-full">SAVE 20%</span>
                            <h3 class="text-lg font-bold text-white mb-2">Team Pass</h3>
                            <p class="text-white/60 text-sm mb-4">10+ attendees group discount</p>
                            <p class="text-3xl font-bold text-amber-400">€39<span class="text-white/40 text-base font-normal">/person</span></p>
                            <p class="text-white/40 text-xs mt-1">Early Bird Price</p>
                        </div>
                    </label>
                </div>

                {{-- Quantity --}}
                <div>
                    <label for="ticket_quantity" class="form-label">Number of Tickets *</label>
                    <div class="flex items-center gap-4">
                        <button type="button" wire:click="$set('ticket_quantity', Math.max(1, {{ $ticket_quantity }} - 1))"
                                class="w-12 h-12 bg-stone-800 hover:bg-stone-700 rounded-xl flex items-center justify-center text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                        <input type="number" id="ticket_quantity" wire:model.live="ticket_quantity"
                               min="1" max="50"
                               class="w-24 text-center form-input text-xl font-bold">
                        <button type="button" wire:click="$set('ticket_quantity', Math.min(50, {{ $ticket_quantity }} + 1))"
                                class="w-12 h-12 bg-stone-800 hover:bg-stone-700 rounded-xl flex items-center justify-center text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                    @if($ticket_type === 'team' && $ticket_quantity < 10)
                        <p class="text-amber-400 text-sm mt-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Team pass requires minimum 10 tickets
                        </p>
                    @endif
                </div>

                {{-- Order Summary --}}
                <div class="p-6 bg-stone-800/50 border border-stone-700 rounded-2xl">
                    <h4 class="text-lg font-semibold text-white mb-4">Order Summary</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between text-white/70">
                            <span>{{ ucfirst($ticket_type) }} Ticket × {{ $ticket_quantity }}</span>
                            <span>€{{ number_format(($ticket_type === 'individual' ? 49 : 39) * $ticket_quantity, 2) }}</span>
                        </div>
                        <div class="border-t border-stone-700 pt-3 flex justify-between text-lg font-bold text-white">
                            <span>Total</span>
                            <span class="text-amber-400">{{ $this->formattedPrice }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ================================
            STEP 3: Church Info (Ministry Team)
        ================================= --}}
        @if($currentStep === 3 && $type === 'ministry')
            <div class="space-y-6 animate-fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Church Information</h2>
                    <p class="text-white/60">Tell us about your church</p>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    {{-- Church Name --}}
                    <div>
                        <label for="church_name" class="form-label">Church Name *</label>
                        <input type="text" id="church_name" wire:model="church_name"
                               class="form-input @error('church_name') !border-red-500 @enderror"
                               placeholder="Your home church name">
                        @error('church_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Church City --}}
                    <div>
                        <label for="church_city" class="form-label">Church City *</label>
                        <input type="text" id="church_city" wire:model="church_city"
                               class="form-input @error('church_city') !border-red-500 @enderror"
                               placeholder="City where your church is located">
                        @error('church_city')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    {{-- Pastor Name --}}
                    <div>
                        <label for="pastor_name" class="form-label">Senior Pastor's Name *</label>
                        <input type="text" id="pastor_name" wire:model="pastor_name"
                               class="form-input @error('pastor_name') !border-red-500 @enderror"
                               placeholder="Pastor's full name">
                        @error('pastor_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pastor Email --}}
                    <div>
                        <label for="pastor_email" class="form-label">Pastor's Email *</label>
                        <input type="email" id="pastor_email" wire:model="pastor_email"
                               class="form-input @error('pastor_email') !border-red-500 @enderror"
                               placeholder="pastor@church.com">
                        @error('pastor_email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        {{-- ================================
            STEP 4: Testimony & References (Ministry Team)
        ================================= --}}
        @if($currentStep === 4 && $type === 'ministry')
            <div class="space-y-6 animate-fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Spiritual Background</h2>
                    <p class="text-white/60">Share your testimony with us</p>
                </div>

                {{-- Spiritual Checkboxes --}}
                <div class="space-y-4">
                    <label class="flex items-start gap-4 p-4 bg-stone-900 border border-stone-700 rounded-xl cursor-pointer hover:border-amber-500/50 transition-colors">
                        <input type="checkbox" wire:model="is_born_again" class="form-checkbox mt-0.5">
                        <div>
                            <span class="text-white font-medium">I am a born-again believer *</span>
                            <p class="text-white/50 text-sm mt-1">I have accepted Jesus Christ as my Lord and Savior</p>
                        </div>
                    </label>
                    @error('is_born_again')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <label class="flex items-start gap-4 p-4 bg-stone-900 border border-stone-700 rounded-xl cursor-pointer hover:border-amber-500/50 transition-colors">
                        <input type="checkbox" wire:model="is_spirit_filled" class="form-checkbox mt-0.5">
                        <div>
                            <span class="text-white font-medium">I am Spirit-filled *</span>
                            <p class="text-white/50 text-sm mt-1">I have received the baptism of the Holy Spirit</p>
                        </div>
                    </label>
                    @error('is_spirit_filled')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Testimony --}}
                <div>
                    <label for="testimony" class="form-label">Your Testimony *</label>
                    <textarea id="testimony" wire:model="testimony" rows="6"
                              class="form-input resize-none @error('testimony') !border-red-500 @enderror"
                              placeholder="Please share your testimony and calling to ministry (minimum 100 characters)..."></textarea>
                    <p class="text-white/40 text-sm mt-1">{{ strlen($testimony) }}/3000 characters</p>
                    @error('testimony')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ministry School --}}
                <div class="space-y-4">
                    <label class="flex items-center gap-3">
                        <input type="checkbox" wire:model.live="attended_ministry_school" class="form-checkbox">
                        <span class="text-white/80">I have attended a ministry/Bible school</span>
                    </label>

                    @if($attended_ministry_school)
                        <div>
                            <label for="ministry_school_name" class="form-label">School Name</label>
                            <input type="text" id="ministry_school_name" wire:model="ministry_school_name"
                                   class="form-input"
                                   placeholder="Name of the school">
                        </div>
                    @endif
                </div>

                {{-- References --}}
                <div class="space-y-4">
                    <h4 class="text-white font-semibold">References *</h4>
                    <p class="text-white/60 text-sm">Please provide two references who can vouch for your character and ministry readiness.</p>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="reference_1_name" class="form-label">Reference 1 Name *</label>
                            <input type="text" id="reference_1_name" wire:model="reference_1_name"
                                   class="form-input @error('reference_1_name') !border-red-500 @enderror"
                                   placeholder="Full name">
                        </div>
                        <div>
                            <label for="reference_1_email" class="form-label">Reference 1 Email *</label>
                            <input type="email" id="reference_1_email" wire:model="reference_1_email"
                                   class="form-input @error('reference_1_email') !border-red-500 @enderror"
                                   placeholder="Email address">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="reference_2_name" class="form-label">Reference 2 Name *</label>
                            <input type="text" id="reference_2_name" wire:model="reference_2_name"
                                   class="form-input @error('reference_2_name') !border-red-500 @enderror"
                                   placeholder="Full name">
                        </div>
                        <div>
                            <label for="reference_2_email" class="form-label">Reference 2 Email *</label>
                            <input type="email" id="reference_2_email" wire:model="reference_2_email"
                                   class="form-input @error('reference_2_email') !border-red-500 @enderror"
                                   placeholder="Email address">
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ================================
            FINAL STEP: Review & Agreement
        ================================= --}}
        @if($currentStep === $totalSteps)
            <div class="space-y-6 animate-fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Almost Done!</h2>
                    <p class="text-white/60">Review and confirm your registration</p>
                </div>

                {{-- Summary Card --}}
                <div class="p-6 bg-stone-800/50 border border-stone-700 rounded-2xl">
                    <h4 class="text-lg font-semibold text-white mb-4">Registration Summary</h4>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-white/60">Name</dt>
                            <dd class="text-white font-medium">{{ $first_name }} {{ $last_name }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-white/60">Email</dt>
                            <dd class="text-white font-medium">{{ $email }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-white/60">Location</dt>
                            <dd class="text-white font-medium">{{ $city }}, {{ $country }}</dd>
                        </div>
                        @if($type === 'attendee')
                            <div class="border-t border-stone-700 pt-3 flex justify-between">
                                <dt class="text-white/60">Tickets</dt>
                                <dd class="text-white font-medium">{{ $ticket_quantity }}× {{ ucfirst($ticket_type) }}</dd>
                            </div>
                            <div class="flex justify-between text-lg font-bold">
                                <dt class="text-white">Total</dt>
                                <dd class="text-amber-400">{{ $this->formattedPrice }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                {{-- Ministry Team Guidelines --}}
                @if($type === 'ministry')
                    <div class="p-6 bg-amber-500/10 border border-amber-500/30 rounded-2xl">
                        <h4 class="text-lg font-semibold text-amber-400 mb-4">Ministry Team Guidelines</h4>
                        <ul class="space-y-2 text-white/70 text-sm">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Arrive in Budapest by October 21st, 2026
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Attend mandatory training on October 22nd
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Be available for all conference sessions Oct 23-25
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Serve with excellence and humility
                            </li>
                        </ul>
                    </div>

                    <label class="flex items-start gap-4 p-4 bg-stone-900 border border-stone-700 rounded-xl cursor-pointer hover:border-amber-500/50 transition-colors">
                        <input type="checkbox" wire:model="accepts_guidelines" class="form-checkbox mt-0.5">
                        <div>
                            <span class="text-white font-medium">I accept the Ministry Team Guidelines *</span>
                            <p class="text-white/50 text-sm mt-1">I understand and commit to the requirements above</p>
                        </div>
                    </label>
                    @error('accepts_guidelines')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                @endif

                {{-- Terms & Conditions --}}
                <label class="flex items-start gap-4 p-4 bg-stone-900 border border-stone-700 rounded-xl cursor-pointer hover:border-amber-500/50 transition-colors">
                    <input type="checkbox" wire:model="accepts_terms" class="form-checkbox mt-0.5">
                    <div>
                        <span class="text-white font-medium">I accept the Terms & Conditions *</span>
                        <p class="text-white/50 text-sm mt-1">
                            I have read and agree to the 
                            <a href="{{ route('terms') }}" target="_blank" class="text-amber-400 hover:underline">Terms of Service</a> 
                            and 
                            <a href="{{ route('privacy') }}" target="_blank" class="text-amber-400 hover:underline">Privacy Policy</a>
                        </p>
                    </div>
                </label>
                @error('accepts_terms')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        @endif

        {{-- ================================
            Navigation Buttons
        ================================= --}}
        <div class="flex items-center justify-between pt-6 border-t border-stone-800">
            @if($currentStep > 1)
                <button type="button" wire:click="previousStep"
                        class="inline-flex items-center gap-2 px-6 py-3 text-white/70 hover:text-white font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back
                </button>
            @else
                <div></div>
            @endif

            @if($currentStep < $totalSteps)
                <button type="button" wire:click="nextStep"
                        class="btn-primary">
                    Continue
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            @else
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="btn-primary relative">
                    <span wire:loading.remove>
                        @if($type === 'attendee')
                            Proceed to Payment
                        @else
                            Submit Application
                        @endif
                    </span>
                    <span wire:loading class="inline-flex items-center gap-2">
                        <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </span>
                </button>
            @endif
        </div>
    </form>
</div>
