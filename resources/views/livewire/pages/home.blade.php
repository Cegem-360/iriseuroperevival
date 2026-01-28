<div>
{{-- ============================================
    HERO SECTION
============================================= --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Video Background --}}
    <div class="absolute inset-0 z-0">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('videos/worship-background.mp4') }}" type="video/mp4">
        </video>
        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-stone-950/70 via-stone-950/50 to-stone-950"></div>
        {{-- Texture Overlay --}}
        <div class="absolute inset-0 opacity-30" style="background-image: url('{{ asset('images/textures/noise.png') }}'); background-repeat: repeat;"></div>
    </div>

    {{-- Hero Content --}}
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center pt-32 pb-20">
        {{-- Conference Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full mb-8 animate-fade-in">
            <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
            <span class="text-white/80 text-sm font-medium">October 23-25, 2026 • Budapest, Hungary</span>
        </div>

        {{-- Main Logo/Title --}}
        <div class="mb-8 animate-fade-in-up">
            <img src="{{ asset('images/europe-revival-logo.svg') }}" 
                 alt="Europe Revival 2026" 
                 class="h-20 md:h-28 mx-auto mb-6">
        </div>

        {{-- Tagline Image --}}
        <div class="mb-10 animate-fade-in-up" style="animation-delay: 0.1s;">
            <img src="{{ asset('images/encounter-jesus-tagline.webp') }}" 
                 alt="Encounter Jesus. Catch on Fire." 
                 class="h-16 md:h-24 mx-auto">
        </div>

        {{-- Description --}}
        <p class="text-xl md:text-2xl text-white/70 max-w-2xl mx-auto mb-10 animate-fade-in-up" style="animation-delay: 0.2s;">
            A 3-day conference for everyone seeking <span class="text-amber-400">revival</span>, 
            <span class="text-amber-400">healing</span>, and a fresh <span class="text-amber-400">encounter</span> with Jesus.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16 animate-fade-in-up" style="animation-delay: 0.3s;">
            <a href="{{ route('register') }}" 
               class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-stone-900 font-bold text-lg rounded-full transition-all duration-300 shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 hover:scale-105">
                Register Now
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <button @click="$dispatch('open-video-modal')" 
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 text-white font-semibold text-lg rounded-full transition-all duration-300">
                <span class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors">
                    <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </span>
                Watch Trailer
            </button>
        </div>

        {{-- Video Thumbnail Preview --}}
        <div class="relative max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50 cursor-pointer group"
                 @click="$dispatch('open-video-modal')">
                <img src="{{ asset('images/hero-video-thumbnail.webp') }}" 
                     alt="Europe Revival 2025 Highlights" 
                     class="w-full aspect-video object-cover transition-transform duration-700 group-hover:scale-105">
                {{-- Play Button Overlay --}}
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-colors">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/40 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
                {{-- Caption --}}
                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                    <p class="text-white/80 text-sm">Watch highlights from Europe Revival 2025</p>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <a href="#speakers" class="flex flex-col items-center gap-2 text-white/50 hover:text-white/80 transition-colors">
                <span class="text-xs uppercase tracking-widest">Scroll</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Texture Transition --}}
<div class="h-24 bg-gradient-to-b from-stone-950 to-stone-900 relative overflow-hidden">
    <img src="{{ asset('images/textures/transition-subtle.webp') }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-20">
</div>

{{-- ============================================
    SPEAKERS SECTION
============================================= --}}
<section id="speakers" class="py-24 bg-stone-900 relative">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5" style="background-image: url('{{ asset('images/textures/noise.png') }}');"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/30 rounded-full mb-4">
                Featured Speakers
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">World-Class Speakers</h2>
            <p class="text-white/50 text-lg max-w-2xl mx-auto">
                Anointed ministers from around the world sharing powerful messages of revival and transformation
            </p>
        </div>

        {{-- Speakers Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($featuredSpeakers as $speaker)
                <x-home.speaker-card :speaker="$speaker" wire:key="speaker-{{ $speaker->id }}" />
            @endforeach
        </div>

        {{-- Workshop Leaders --}}
        @if($workshopLeaders->isNotEmpty())
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-white text-center mb-8">Workshop Leaders</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach($workshopLeaders as $speaker)
                        <x-home.speaker-card :speaker="$speaker" :showArrow="false" wire:key="workshop-{{ $speaker->id }}" />
                    @endforeach

                    {{-- More Coming --}}
                    <x-home.more-speakers-card />
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ============================================
    THEME SECTION
============================================= --}}
<section id="theme" class="py-24 bg-stone-950 relative overflow-hidden">
    {{-- Background Artwork --}}
    <div class="absolute right-0 top-0 w-1/2 h-full opacity-20">
        <img src="{{ asset('images/encounter-jesus-artwork.webp') }}" alt="" class="w-full h-full object-cover object-left">
        <div class="absolute inset-0 bg-gradient-to-r from-stone-950 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left: Artwork --}}
            <div class="relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/encounter-jesus-artwork.webp') }}" 
                         alt="Encounter Jesus" 
                         class="w-full aspect-[4/5] object-cover">
                    {{-- Glow Effect --}}
                    <div class="absolute -inset-4 bg-amber-500/20 blur-3xl -z-10"></div>
                </div>
                {{-- Floating Badge --}}
                <div class="absolute -bottom-6 -right-6 bg-gradient-to-br from-amber-500 to-orange-500 text-stone-900 px-6 py-4 rounded-2xl shadow-xl">
                    <span class="text-4xl font-bold">2026</span>
                    <span class="block text-sm font-medium opacity-80">Conference Theme</span>
                </div>
            </div>

            {{-- Right: Content --}}
            <div>
                <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/30 rounded-full mb-6">
                    This Year's Theme
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Encounter Jesus.<br>
                    <span class="text-gradient">Catch on Fire.</span>
                </h2>
                <p class="text-white/60 text-lg mb-8 leading-relaxed">
                    In a world searching for meaning, we gather to encounter the One who sets hearts ablaze. 
                    This isn't just another conference—it's a divine appointment where Heaven meets earth, 
                    and ordinary lives become carriers of extraordinary fire.
                </p>

                {{-- Theme Points --}}
                <div class="space-y-6 mb-10">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-1">Encounter God's Presence</h4>
                            <p class="text-white/50 text-sm">Experience powerful worship and encounter the tangible presence of the Holy Spirit</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-1">Catch the Fire of Revival</h4>
                            <p class="text-white/50 text-sm">Receive fresh impartation and be ignited with passion for the lost</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-1">Spread Revival to the Nations</h4>
                            <p class="text-white/50 text-sm">Take the flame back to your city and become a carrier of awakening</p>
                        </div>
                    </div>
                </div>

                {{-- Scripture --}}
                <blockquote class="border-l-4 border-amber-500 pl-6 py-2">
                    <p class="text-white/80 italic text-lg mb-2">"I have come to bring fire on the earth, and how I wish it were already kindled!"</p>
                    <cite class="text-amber-400 text-sm font-medium">— Luke 12:49</cite>
                </blockquote>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    SCHEDULE SECTION
============================================= --}}
<section id="schedule" class="py-24 bg-stone-900 relative" x-data="{ activeTab: 'main' }">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/30 rounded-full mb-4">
                Conference Schedule
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">3 Days of Encounter</h2>
            <p class="text-white/50 text-lg max-w-2xl mx-auto">
                Powerful sessions, workshops, healing rooms, and supernatural encounters await
            </p>
        </div>

        @if($scheduleDays->isNotEmpty())
            @php
                $trainingDay = $scheduleDays->first(fn($day) => $day['is_training_day']);
                $mainDays = $scheduleDays->filter(fn($day) => !$day['is_training_day']);
            @endphp

            {{-- Tab Buttons --}}
            <div class="flex justify-center gap-2 mb-12 flex-wrap">
                @if($trainingDay)
                    <button @click="activeTab = 'training'"
                            :class="activeTab === 'training' ? 'bg-amber-500 text-stone-900' : 'bg-stone-800 text-white/70 hover:text-white'"
                            class="px-6 py-3 rounded-full font-semibold transition-all">
                        Training Day ({{ \Carbon\Carbon::parse($trainingDay['date'])->format('M j') }})
                    </button>
                @endif
                <button @click="activeTab = 'main'"
                        :class="activeTab === 'main' ? 'bg-amber-500 text-stone-900' : 'bg-stone-800 text-white/70 hover:text-white'"
                        class="px-6 py-3 rounded-full font-semibold transition-all">
                    Main Conference (Oct 23-25)
                </button>
            </div>

            {{-- Training Day Schedule --}}
            @if($trainingDay)
                <div x-show="activeTab === 'training'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="max-w-3xl mx-auto">
                        <div class="bg-stone-800/50 border border-stone-700 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-14 h-14 bg-amber-500/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Ministry Team Training</h3>
                                    <p class="text-white/50">{{ $trainingDay['formatted_date'] }}</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                @foreach($trainingDay['items'] as $item)
                                    <div class="flex gap-4 p-4 bg-stone-700/30 rounded-xl">
                                        <span class="text-amber-400 font-mono font-semibold w-24 flex-shrink-0">
                                            {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}
                                        </span>
                                        <div>
                                            <h4 class="text-white font-medium">{{ $item->title }}</h4>
                                            @if($item->description)
                                                <p class="text-white/50 text-sm">{{ Str::limit($item->description, 60) }}</p>
                                            @endif
                                            @if($item->speaker)
                                                <p class="text-amber-400/70 text-sm mt-1">with {{ $item->speaker->name }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 p-4 bg-amber-500/10 border border-amber-500/30 rounded-xl">
                                <p class="text-amber-400 text-sm">
                                    <strong>Note:</strong> Training day is mandatory for all ministry team members.
                                    <a href="{{ route('register.ministry') }}" class="underline hover:no-underline">Apply to join the team</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Conference Schedule --}}
            <div x-show="activeTab === 'main'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($mainDays->take(3) as $day)
                        <div class="bg-stone-800/50 border border-stone-700 rounded-2xl overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-4">
                                <span class="text-stone-900/70 text-sm font-medium">Day {{ $loop->iteration }}</span>
                                <h3 class="text-stone-900 text-xl font-bold">{{ $day['formatted_date'] }}</h3>
                            </div>
                            <div class="p-6 space-y-4">
                                @foreach($day['items']->take(5) as $item)
                                    @php
                                        $borderColor = match($item->type) {
                                            'worship' => 'border-amber-500',
                                            'session' => 'border-blue-500',
                                            'meal' => 'border-green-500',
                                            'break' => 'border-stone-500',
                                            'special' => 'border-purple-500',
                                            default => 'border-amber-500',
                                        };
                                        $textColor = match($item->type) {
                                            'worship' => 'text-amber-400',
                                            'session' => 'text-blue-400',
                                            'meal' => 'text-green-400',
                                            'break' => 'text-stone-400',
                                            'special' => 'text-purple-400',
                                            default => 'text-amber-400',
                                        };
                                    @endphp
                                    <div class="border-l-2 {{ $borderColor }} pl-4">
                                        <span class="{{ $textColor }} text-sm font-semibold">
                                            {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                        </span>
                                        <h4 class="text-white font-medium">{{ $item->title }}</h4>
                                        @if($item->speaker)
                                            <p class="text-white/50 text-sm">{{ $item->speaker->name }}</p>
                                        @elseif($item->description)
                                            <p class="text-white/50 text-sm">{{ Str::limit($item->description, 40) }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('program') }}" class="btn-secondary">
                        View Full Program
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        @else
            {{-- Empty State - No Schedule Yet --}}
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-amber-500/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Full Schedule Coming Soon</h3>
                <p class="text-white/50 max-w-md mx-auto mb-8">
                    We're finalizing the conference program. Subscribe to our newsletter to be the first to know when it's released.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="btn-primary">
                        Register Now
                    </a>
                    <a href="{{ route('program') }}" class="btn-secondary">
                        Check Program Page
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ============================================
    PRICING SECTION
============================================= --}}
<section id="pricing" class="py-24 bg-stone-950 relative" x-data="{ 
    activeTier: 'early',
    prices: {
        early: { individual: 49, team: 39 },
        regular: { individual: 59, team: 49 },
        late: { individual: 69, team: 59 }
    }
}">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/30 rounded-full mb-4">
                Pricing
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Secure Your Spot</h2>
            <p class="text-white/50 text-lg max-w-2xl mx-auto">
                Early Bird pricing available until June 30, 2026
            </p>
        </div>

        {{-- Pricing Timeline --}}
        <div class="flex justify-center gap-2 mb-12 flex-wrap">
            <button @click="activeTier = 'early'" 
                    :class="activeTier === 'early' ? 'bg-green-500 text-stone-900' : 'bg-stone-800 text-white/70 hover:text-white'"
                    class="px-5 py-2.5 rounded-full font-medium text-sm transition-all flex items-center gap-2">
                <span class="w-2 h-2 rounded-full" :class="activeTier === 'early' ? 'bg-stone-900' : 'bg-green-500'"></span>
                Early Bird (until June 30)
            </button>
            <button @click="activeTier = 'regular'" 
                    :class="activeTier === 'regular' ? 'bg-amber-500 text-stone-900' : 'bg-stone-800 text-white/70 hover:text-white'"
                    class="px-5 py-2.5 rounded-full font-medium text-sm transition-all flex items-center gap-2">
                <span class="w-2 h-2 rounded-full" :class="activeTier === 'regular' ? 'bg-stone-900' : 'bg-amber-500'"></span>
                Regular (July 1 - Aug 31)
            </button>
            <button @click="activeTier = 'late'" 
                    :class="activeTier === 'late' ? 'bg-red-500 text-white' : 'bg-stone-800 text-white/70 hover:text-white'"
                    class="px-5 py-2.5 rounded-full font-medium text-sm transition-all flex items-center gap-2">
                <span class="w-2 h-2 rounded-full" :class="activeTier === 'late' ? 'bg-white' : 'bg-red-500'"></span>
                Late (Sept 1+)
            </button>
        </div>

        {{-- Pricing Cards --}}
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            {{-- Individual Ticket --}}
            <div class="bg-stone-900/50 border border-stone-700 rounded-3xl p-8 relative overflow-hidden">
                <h3 class="text-2xl font-bold text-white mb-2">Individual</h3>
                <p class="text-white/50 mb-6">Single attendee registration</p>
                
                <div class="mb-8">
                    <span class="text-5xl font-bold text-white">€<span x-text="prices[activeTier].individual"></span></span>
                    <span class="text-white/50">/person</span>
                </div>

                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Access to all main sessions
                    </li>
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Workshop participation
                    </li>
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Healing & Prophetic room access
                    </li>
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Conference materials
                    </li>
                </ul>

                <a href="{{ route('register') }}" class="btn-primary w-full justify-center">
                    Register Now
                </a>
            </div>

            {{-- Team Pass --}}
            <div class="bg-gradient-to-br from-amber-500/10 to-orange-500/10 border-2 border-amber-500/50 rounded-3xl p-8 relative overflow-hidden">
                {{-- Best Value Badge --}}
                <div class="absolute -top-px -right-px">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-stone-900 text-xs font-bold px-4 py-1.5 rounded-bl-xl rounded-tr-3xl">
                        BEST VALUE
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-white mb-2">Team Pass</h3>
                <p class="text-white/50 mb-6">Groups of 10+ attendees</p>
                
                <div class="mb-8">
                    <span class="text-5xl font-bold text-amber-400">€<span x-text="prices[activeTier].team"></span></span>
                    <span class="text-white/50">/person</span>
                    <span class="block text-green-400 text-sm mt-1">Save 20% per person</span>
                </div>

                <ul class="space-y-3 mb-8">
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Everything in Individual
                    </li>
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Group seating area
                    </li>
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Team leader badge
                    </li>
                    <li class="flex items-center gap-3 text-white/70">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Priority check-in
                    </li>
                </ul>

                <a href="{{ route('register') }}?type=team" class="btn-primary w-full justify-center">
                    Register Team
                </a>
            </div>
        </div>

        {{-- Early Bird Banner --}}
        <div class="mt-12 max-w-3xl mx-auto" x-show="activeTier === 'early'">
            <div class="bg-green-500/10 border border-green-500/30 rounded-2xl p-6 flex flex-col md:flex-row items-center gap-4">
                <div class="w-14 h-14 bg-green-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-center md:text-left">
                    <h4 class="text-green-400 font-semibold">Early Bird Pricing Ends June 30, 2026</h4>
                    <p class="text-white/60 text-sm">Lock in the lowest price and save up to €20 per ticket</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    TRAVEL SECTION
============================================= --}}
<section id="travel" class="py-24 bg-stone-900 relative">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/30 rounded-full mb-4">
                Travel & Accommodation
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Plan Your Trip</h2>
            <p class="text-white/50 text-lg max-w-2xl mx-auto">
                Budapest awaits you with world-class hospitality
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Map & Venue --}}
            <div>
                <div class="relative rounded-2xl overflow-hidden mb-6">
                    <img src="{{ asset('images/budapest-map.webp') }}" alt="Budapest Map" class="w-full aspect-video object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-stone-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">BOK Sports Hall</h3>
                                <p class="text-white/70 text-sm">Dózsa György út 1, Budapest 1146</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Venue Info Card --}}
                <div class="bg-stone-800/50 border border-stone-700 rounded-2xl p-6">
                    <h4 class="text-white font-semibold mb-4">Getting There</h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <div>
                                <span class="text-white font-medium">From Airport:</span>
                                <span class="text-white/60 ml-2">30 mins by taxi or 45 mins by public transport</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                            <div>
                                <span class="text-white font-medium">Metro:</span>
                                <span class="text-white/60 ml-2">M1 Yellow Line - Hősök tere station</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hotels --}}
            <div>
                <h3 class="text-2xl font-bold text-white mb-6">Recommended Hotels</h3>
                <div class="space-y-4">
                    {{-- Hotel 1 --}}
                    <div class="bg-stone-800/50 border border-stone-700 rounded-2xl p-5 flex gap-4 hover:border-amber-500/30 transition-colors">
                        <img src="{{ asset('images/hotels/hotel-1.webp') }}" alt="Danubius Hotel" class="w-24 h-24 rounded-xl object-cover flex-shrink-0">
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-white font-semibold">Danubius Hotel Helia</h4>
                                    <p class="text-white/50 text-sm">4-star • 0.8 km from venue</p>
                                </div>
                                <span class="text-amber-400 font-semibold">from €85</span>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-yellow-400 text-sm">★★★★☆</span>
                                <span class="text-white/40 text-sm">8.2/10</span>
                            </div>
                        </div>
                    </div>

                    {{-- Hotel 2 --}}
                    <div class="bg-stone-800/50 border border-stone-700 rounded-2xl p-5 flex gap-4 hover:border-amber-500/30 transition-colors">
                        <img src="{{ asset('images/hotels/hotel-2.webp') }}" alt="Novotel Budapest" class="w-24 h-24 rounded-xl object-cover flex-shrink-0">
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-white font-semibold">Novotel Budapest Centrum</h4>
                                    <p class="text-white/50 text-sm">4-star • 2.5 km from venue</p>
                                </div>
                                <span class="text-amber-400 font-semibold">from €75</span>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-yellow-400 text-sm">★★★★☆</span>
                                <span class="text-white/40 text-sm">8.5/10</span>
                            </div>
                        </div>
                    </div>

                    {{-- Hotel 3 --}}
                    <div class="bg-stone-800/50 border border-stone-700 rounded-2xl p-5 flex gap-4 hover:border-amber-500/30 transition-colors">
                        <img src="{{ asset('images/hotels/hotel-3.webp') }}" alt="MEININGER Budapest" class="w-24 h-24 rounded-xl object-cover flex-shrink-0">
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-white font-semibold">MEININGER Budapest</h4>
                                    <p class="text-white/50 text-sm">Budget • 3 km from venue</p>
                                </div>
                                <span class="text-amber-400 font-semibold">from €35</span>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-yellow-400 text-sm">★★★☆☆</span>
                                <span class="text-white/40 text-sm">8.0/10</span>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-white/40 text-sm mt-6">
                    * Prices are approximate and subject to change. We recommend booking early for best rates.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    SPONSORS SECTION
============================================= --}}
<section class="py-24 bg-stone-950">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Main Partner --}}
        @if($mainSponsor)
            <div class="text-center mb-16">
                <span class="text-white/40 text-sm uppercase tracking-wider mb-4 block">Presented by</span>
                <x-home.sponsor-logo :sponsor="$mainSponsor" size="main" />
            </div>
        @endif

        {{-- Partners Grid --}}
        @if($partnerSponsors->isNotEmpty())
            <div class="text-center mb-8">
                <span class="text-white/40 text-sm uppercase tracking-wider">Partner Organizations</span>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12 opacity-60">
                @foreach($partnerSponsors as $sponsor)
                    <x-home.sponsor-logo :sponsor="$sponsor" wire:key="sponsor-{{ $sponsor->id }}" />
                @endforeach
            </div>
        @endif

        {{-- Volunteer CTA --}}
        <div class="mt-20 text-center">
            <div class="inline-block bg-stone-900/50 border border-stone-700 rounded-2xl p-8 max-w-2xl">
                <div class="w-16 h-16 bg-amber-500/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Want to Serve?</h3>
                <p class="text-white/60 mb-6">Join our volunteer team and be part of something extraordinary</p>
                <a href="{{ route('volunteer') }}" class="btn-secondary">
                    Apply to Volunteer
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    FAQ SECTION
============================================= --}}
<section id="faq" class="py-24 bg-stone-900" x-data="{ openFaq: null }">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/30 rounded-full mb-4">
                FAQ
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Questions & Answers</h2>
            <p class="text-white/50 text-lg">Everything you need to know about Europe Revival 2026</p>
        </div>

        {{-- FAQ Accordion --}}
        <div class="space-y-4">
            @foreach($faqs as $index => $faq)
                <x-home.faq-item :faq="$faq" :index="$index + 1" wire:key="faq-{{ $faq->id }}">
                    @if($faq->category === 'registration')
                        <a href="{{ route('register.ministry') }}" class="inline-flex items-center gap-2 text-amber-400 mt-4 hover:underline">
                            Apply Now
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endif
                </x-home.faq-item>
            @endforeach
        </div>

        {{-- Contact CTA --}}
        <div class="mt-12 text-center">
            <p class="text-white/50 mb-4">Still have questions?</p>
            <a href="mailto:info@europerevival.org" class="text-amber-400 hover:text-amber-300 font-medium transition-colors">
                Contact us at info@europerevival.org
            </a>
        </div>
    </div>
</section>

{{-- ============================================
    FINAL CTA SECTION
============================================= --}}
<section class="py-32 bg-stone-950 relative overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-transparent to-stone-950"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: url('{{ asset('images/textures/noise.png') }}');"></div>
        {{-- Glow Effects --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-amber-500/20 rounded-full blur-[150px]"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        {{-- Theme Logo --}}
        <div class="mb-8">
            <img src="{{ asset('images/encounter-jesus-tagline.webp') }}" alt="Encounter Jesus. Catch on Fire." class="h-16 md:h-20 mx-auto opacity-80">
        </div>

        <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
            Your encounter awaits.
        </h2>
        <p class="text-xl text-white/60 mb-10 max-w-2xl mx-auto">
            Don't miss this divine appointment. Join thousands of believers from across Europe 
            for three days that could change your life forever.
        </p>

        {{-- CTA --}}
        <a href="{{ route('register') }}" 
           class="group inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-stone-900 font-bold text-xl rounded-full transition-all duration-300 shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 hover:scale-105">
            Register Now — Starting at €49
            <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

        {{-- Date Reminder --}}
        <p class="mt-8 text-white/40">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            October 23-25, 2026 • Budapest, Hungary
        </p>
    </div>
</section>
</div>