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
                Registration Complete!
            @elseif($registration->type === 'ministry')
                Application Submitted!
            @elseif($registration->type === 'volunteer')
                Thank You for Applying!
            @else
                Thank You!
            @endif
        </h1>

        {{-- Message based on type --}}
        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
            @if($registration->type === 'attendee')
                <p class="text-white/70 text-lg mb-6">
                    Thank you, {{ $registration->first_name }}! Your registration has been confirmed.
                    A confirmation email has been sent to <span class="text-primary-400">{{ $registration->email }}</span>
                </p>
            @elseif($registration->type === 'ministry')
                <p class="text-white/70 text-lg mb-6">
                    Thank you for applying to join the Ministry Team, {{ $registration->first_name }}!
                    Your application is being reviewed. We'll contact you at
                    <span class="text-primary-400">{{ $registration->email }}</span> within 7 business days.
                </p>
            @elseif($registration->type === 'volunteer')
                <p class="text-white/70 text-lg mb-6">
                    Thank you for your application, {{ $registration->first_name }}!
                    Your application is being processed. We will soon send you a confirmation email
                    about your application to <span class="text-primary-400">{{ $registration->email }}</span>.
                </p>
            @else
                <p class="text-white/70 text-lg mb-6">
                    Thank you, {{ $registration->first_name }}!
                    We'll be in touch at <span class="text-primary-400">{{ $registration->email }}</span> soon.
                </p>
            @endif
        </div>

        {{-- Social Share (between thank you text and registration details) --}}
        <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.15s;">
            <x-share-event />
        </div>

        {{-- Registration Details Card --}}
        <div class="bg-navy-900/50 border border-navy-700 rounded-2xl p-6 text-left mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
            <h3 class="text-sm font-semibold text-white/50 uppercase tracking-wider mb-4">Registration Details</h3>
            <dl class="space-y-3">
                <div class="flex justify-between">
                    <dt class="text-white/60">Confirmation #</dt>
                    <dd class="text-white font-mono text-sm">{{ strtoupper(substr($registration->uuid, 0, 8)) }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-white/60">Name</dt>
                    <dd class="text-white">{{ $registration->full_name }}</dd>
                </div>
                @if($registration->type === 'attendee')
                    <div class="flex justify-between">
                        <dt class="text-white/60">Tickets</dt>
                        <dd class="text-white">{{ $registration->ticket_quantity }}× {{ ucfirst($registration->ticket_type) }}</dd>
                    </div>
                    <div class="flex justify-between border-t border-navy-600 pt-3">
                        <dt class="text-white font-semibold">Amount Paid</dt>
                        <dd class="text-primary-400 font-bold">{{ $registration->formatted_amount }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        {{-- What's Next --}}
        <div class="bg-primary-500/10 border border-primary-500/30 rounded-2xl p-6 text-left mb-8 animate-fade-in-up" style="animation-delay: 0.3s;">
            <h3 class="text-lg font-semibold text-primary-400 mb-4">What's Next?</h3>
            <ul class="space-y-3 text-white/70 text-sm">
                @if($registration->type === 'attendee')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Check your email for your ticket and event details</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Add October 23-25, 2026 to your calendar</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>Book your accommodation in Budapest</span>
                    </li>
                @elseif($registration->type === 'ministry')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Your references will be contacted for verification</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Expect a response within 7 business days</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>If approved, arrive by October 21st for training</span>
                    </li>
                @elseif($registration->type === 'volunteer')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>We will review your application and get back to you soon</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>If approved, you will receive a coupon code for your discounted ticket</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>We will send more details about your volunteer work by email</span>
                    </li>
                @else
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>You'll receive further details by email</span>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.4s;">
            <a href="{{ route('home') }}" class="btn-primary">
                Back to Home
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
        </div>

    </div>
</div>
</div>
