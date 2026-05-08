<div>
<div class="min-h-screen bg-navy-950 flex items-center justify-center px-4 py-20">
    <div class="max-w-lg w-full text-center">
        {{-- Success Animation --}}
        <div class="mb-8 animate-scale-in">
            <div class="w-24 h-24 mx-auto bg-linear-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-green-500/30">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 animate-fade-in-up">
            @if($registration->type === 'attendee')
                {{ __('Registration Complete!') }}
            @elseif($registration->type === 'ministry')
                {{ __('Application Submitted!') }}
            @elseif($registration->type === 'volunteer')
                {{ __('Thank You for Applying!') }}
            @else
                {{ __('Thank You!') }}
            @endif
        </h1>

        {{-- Message based on type --}}
        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
            @if($registration->type === 'attendee')
                <p class="text-white/70 text-lg mb-6">
                    {!! __('Thank you, :name! Your registration has been confirmed. A confirmation email has been sent to :email', ['name' => e($registration->first_name), 'email' => '<span class="text-primary-400">' . e($registration->email) . '</span>']) !!}
                </p>
            @elseif($registration->type === 'ministry')
                <p class="text-white/70 text-lg mb-6">
                    {!! __('Thank you for applying to join the Ministry Team, :name! Your application is currently under review. We will get back to you soon at :email.', ['name' => e($registration->first_name), 'email' => '<span class="text-primary-400">' . e($registration->email) . '</span>']) !!}
                </p>
            @elseif($registration->type === 'volunteer')
                <p class="text-white/70 text-lg mb-6">
                    {!! __('Thank you for your application, :name! Your application is being processed. We will soon send you a confirmation email about your application to :email.', ['name' => e($registration->first_name), 'email' => '<span class="text-primary-400">' . e($registration->email) . '</span>']) !!}
                </p>
            @else
                <p class="text-white/70 text-lg mb-6">
                    {!! __("Thank you, :name! We'll be in touch at :email soon.", ['name' => e($registration->first_name), 'email' => '<span class="text-primary-400">' . e($registration->email) . '</span>']) !!}
                </p>
            @endif
        </div>

        {{-- Social Share (between thank you text and registration details) --}}
        <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.15s;">
            <x-share-event />
        </div>

        {{-- Registration Details Card --}}
        <div class="bg-navy-900/50 border border-navy-700 rounded-2xl p-6 text-left mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
            <h3 class="text-sm font-semibold text-white/50 uppercase tracking-wider mb-4">{{ __('Registration Details') }}</h3>
            <dl class="space-y-3">
                <div class="flex justify-between">
                    <dt class="text-white/60">{{ __('Confirmation #') }}</dt>
                    <dd class="text-white font-mono text-sm">{{ strtoupper(substr($registration->uuid, 0, 8)) }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-white/60">{{ __('Name') }}</dt>
                    <dd class="text-white">{{ $registration->full_name }}</dd>
                </div>
                @if($registration->type === 'attendee')
                    <div class="flex justify-between">
                        <dt class="text-white/60">{{ __('Tickets') }}</dt>
                        <dd class="text-white">{{ $registration->ticket_quantity }}× {{ __(ucfirst($registration->ticket_type)) }}</dd>
                    </div>
                    <div class="flex justify-between border-t border-navy-600 pt-3">
                        <dt class="text-white font-semibold">{{ __('Amount Paid') }}</dt>
                        <dd class="text-primary-400 font-bold">{{ $registration->formatted_amount }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        {{-- What's Next --}}
        <div class="bg-primary-500/10 border border-primary-500/30 rounded-2xl p-6 text-left mb-8 animate-fade-in-up" style="animation-delay: 0.3s;">
            <h3 class="text-lg font-semibold text-primary-400 mb-4">{{ __("What's Next?") }}</h3>
            <ul class="space-y-3 text-white/70 text-sm">
                @if($registration->type === 'attendee')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('Check your email for your ticket and event details') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('Add October 23-25, 2026 to your calendar') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>{{ __('Book your accommodation in Budapest') }}</span>
                    </li>
                @elseif($registration->type === 'ministry')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('Your pastor / reference will be contacted for verification.') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('You can expect a response within one month.') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('If approved, arrive by October 21st for training.') }}</span>
                    </li>
                @elseif($registration->type === 'volunteer')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('We will review your application and get back to you soon') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('If approved, you will receive a coupon code for your discounted ticket') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>{{ __('We will send more details about your volunteer work by email') }}</span>
                    </li>
                @else
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __("You'll receive further details by email") }}</span>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.4s;">
            <a href="{{ route('home') }}" class="btn-primary">
                {{ __('Back to Home') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
        </div>

    </div>
</div>
</div>
