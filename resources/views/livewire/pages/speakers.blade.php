<div>
    {{-- Hero Section --}}
    <section class="relative py-24 bg-navy-950">
        <div class="absolute inset-0 opacity-5" style="background-image: url('{{ Vite::asset('resources/images/textures/noise.png') }}');"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="text-center mb-4">
                <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                    Europe Revival 2026
                </span>
                <h1 class="text-4xl md:text-6xl font-bold uppercase mb-6">{{ __('Our Speakers') }}</h1>
                <p class="text-xl text-white/50 max-w-2xl mx-auto">
                    {{ __('Meet the anointed men and women of God who will be ministering at Europe Revival 2026.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- Featured Speakers --}}
    @if($featuredSpeakers->isNotEmpty())
        <section class="py-20 bg-navy-800">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                        {{ __('Featured Speakers') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ __('Speakers') }}</h2>
                    <p class="text-white/50 max-w-xl mx-auto">
                        {{ __('Powerful voices bringing messages of revival, healing, and transformation') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach($featuredSpeakers as $speaker)
                        <x-home.speaker-card :speaker="$speaker" wire:key="featured-{{ $speaker->id }}" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Workshop Leaders --}}
    @if($workshopLeaders->isNotEmpty())
        <section class="py-20 bg-navy-900">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                        {{ __('Workshop Leaders') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ __('Expert Teachers') }}</h2>
                    <p class="text-white/50 max-w-xl mx-auto">
                        {{ __('Leading interactive sessions on specialized topics') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach($workshopLeaders as $speaker)
                        <x-home.speaker-card :speaker="$speaker" :showArrow="false" wire:key="workshop-{{ $speaker->id }}" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Worship Leaders --}}
    @if($worshipLeaders->isNotEmpty())
        <section class="py-20 bg-navy-800">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                        {{ __('Worship Leaders') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ __('Anointed Worshippers') }}</h2>
                    <p class="text-white/50 max-w-xl mx-auto">
                        {{ __('Creating an atmosphere for encounter with God') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach($worshipLeaders as $speaker)
                        <x-home.speaker-card :speaker="$speaker" :showArrow="false" wire:key="worship-{{ $speaker->id }}" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Empty State --}}
    @if($featuredSpeakers->isEmpty() && $workshopLeaders->isEmpty() && $worshipLeaders->isEmpty())
        <section class="py-32 bg-navy-800">
            <div class="max-w-2xl mx-auto px-4 text-center">
                <div class="w-20 h-20 bg-sky-400/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold mb-4">{{ __('Speaker Announcements Coming Soon') }}</h2>
                <p class="text-white/50 mb-8">
                    {{ __("We're excited to announce our lineup of incredible speakers. Check back soon for updates!") }}
                </p>
                <a href="{{ route('home') }}#speakers" class="btn-primary">
                    {{ __('Back to Home') }}
                </a>
            </div>
        </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-20 bg-navy-950">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">{{ __("Don't Miss This Opportunity") }}</h2>
            <p class="text-white/50 mb-8">
                {{ __('Register now to secure your spot and experience these powerful ministers in person.') }}
            </p>
            <a href="{{ route('register') }}" class="btn-primary">
                {{ __('Register Now') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
</div>
