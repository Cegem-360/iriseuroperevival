<div>
<div class="min-h-screen bg-stone-950 flex items-center justify-center px-4 py-20">
    <div class="max-w-lg w-full text-center">
        {{-- Success Animation --}}
        <div class="mb-8 animate-scale-in">
            <div class="w-24 h-24 mx-auto bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-green-500/30">
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
            @else
                Thank You!
            @endif
        </h1>

        {{-- Message based on type --}}
        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
            @if($registration->type === 'attendee')
                <p class="text-white/70 text-lg mb-6">
                    Thank you, {{ $registration->first_name }}! Your registration has been confirmed. 
                    A confirmation email has been sent to <span class="text-amber-400">{{ $registration->email }}</span>
                </p>
            @elseif($registration->type === 'ministry')
                <p class="text-white/70 text-lg mb-6">
                    Thank you for applying to join the Ministry Team, {{ $registration->first_name }}! 
                    Your application is being reviewed. We'll contact you at 
                    <span class="text-amber-400">{{ $registration->email }}</span> within 7 business days.
                </p>
            @else
                <p class="text-white/70 text-lg mb-6">
                    Thank you for your volunteer application, {{ $registration->first_name }}! 
                    We'll be in touch at <span class="text-amber-400">{{ $registration->email }}</span> soon.
                </p>
            @endif
        </div>

        {{-- Registration Details Card --}}
        <div class="bg-stone-900/50 border border-stone-800 rounded-2xl p-6 text-left mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
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
                    <div class="flex justify-between border-t border-stone-700 pt-3">
                        <dt class="text-white font-semibold">Amount Paid</dt>
                        <dd class="text-amber-400 font-bold">{{ $registration->formatted_amount }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        {{-- What's Next --}}
        <div class="bg-amber-500/10 border border-amber-500/30 rounded-2xl p-6 text-left mb-8 animate-fade-in-up" style="animation-delay: 0.3s;">
            <h3 class="text-lg font-semibold text-amber-400 mb-4">What's Next?</h3>
            <ul class="space-y-3 text-white/70 text-sm">
                @if($registration->type === 'attendee')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Check your email for your ticket and event details</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Add October 23-25, 2026 to your calendar</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>Book your accommodation in Budapest</span>
                    </li>
                @elseif($registration->type === 'ministry')
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Your references will be contacted for verification</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Expect a response within 7 business days</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>If approved, arrive by October 21st for training</span>
                    </li>
                @else
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>You'll receive shift assignments by email</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Join our volunteer orientation session</span>
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
            <a href="#travel" class="btn-secondary">
                Book Accommodation
            </a>
        </div>

        {{-- Social Share --}}
        <div class="mt-12 pt-8 border-t border-stone-800 animate-fade-in-up" style="animation-delay: 0.5s;">
            <p class="text-white/50 text-sm mb-4">Share the news!</p>
            <div class="flex justify-center gap-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('home')) }}" 
                   target="_blank"
                   class="w-10 h-10 bg-stone-800 hover:bg-stone-700 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode('I just registered for Europe Revival 2026! 🔥 Encounter Jesus. Catch on Fire. October 23-25, Budapest.') }}&url={{ urlencode(route('home')) }}" 
                   target="_blank"
                   class="w-10 h-10 bg-stone-800 hover:bg-stone-700 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <a href="mailto:?subject={{ urlencode('Europe Revival 2026') }}&body={{ urlencode('I just registered for Europe Revival 2026! Join me in Budapest, October 23-25, 2026. Register at: ' . route('home')) }}" 
                   class="w-10 h-10 bg-stone-800 hover:bg-stone-700 rounded-full flex items-center justify-center text-white/60 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
</div>