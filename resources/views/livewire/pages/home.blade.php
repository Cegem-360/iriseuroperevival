<div>
    {{-- ============================================
    HERO SECTION
============================================= --}}
    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
        {{-- Image Background --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ Vite::asset('resources/images/crowd-3.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover">
            {{-- Video Background (hidden for now)
            <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
                <source src="{{ Vite::asset('resources/videos/worship-background.webm') }}" type="video/webm">
            </video>
            --}}
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-linear-to-b from-navy-950/70 via-navy-950/50 to-navy-950"></div>
            {{-- Texture Overlay --}}
            <div class="absolute inset-0 opacity-30"
                style="background-image: url('{{ Vite::asset('resources/images/textures/noise.png') }}'); background-repeat: repeat;">
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-10 max-w-5xl mx-auto px-4 text-center pt-32 pb-20">
            {{-- Conference Badge --}}
            <div
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full mb-8 animate-fade-in">
                <span class="w-2 h-2 bg-primary-400 rounded-full animate-pulse"></span>
                <span class="text-white text-base md:text-lg font-semibold">October 23-25, 2026 • Budapest, {{ app()->getLocale() === 'hu' ? 'BOK Csarnok' : 'BOK Hall' }}</span>
            </div>

            {{-- Main Logo/Title --}}
            <div class="mb-8 animate-fade-in-up">
                <img src="{{ Vite::asset('resources/images/europe-revival-2026-logo.webp') }}" alt="Europe Revival 2026"
                    class="h-20 md:h-28 mx-auto mb-6">
            </div>

            {{-- Tagline --}}
            <div class="mb-10 animate-fade-in-up" style="animation-delay: 0.1s;">
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                    Encounter Jesus<br>
                    <span class="text-gradient">Catch on Fire</span>
                </h1>
            </div>

            {{-- Description --}}
            <p class="text-xl md:text-2xl text-white/70 max-w-3xl mx-auto mb-10 animate-fade-in-up"
                style="animation-delay: 0.2s;">
                A three-day gathering to encounter Jesus, fall deeply in love with Him, and be sent to carry His heart for the lost across Europe.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16 animate-fade-in-up"
                style="animation-delay: 0.3s;">
                <a href="{{ route('register') }}"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-linear-to-r from-primary-400 to-primary-600 hover:from-primary-500 hover:to-primary-700 text-navy-900 font-bold text-lg rounded-full transition-all duration-300 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:scale-105">
                    Register Now
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <button @click="$dispatch('open-vision-modal')"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 text-white font-semibold text-lg rounded-full transition-all duration-300">
                    <span
                        class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                    See the Vision
                </button>
            </div>

            {{-- Promo Video - Coming Soon (replace with video player when ready) --}}
            <div class="relative max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50">
                    <img src="{{ Vite::asset('resources/images/close-up-of-podium-with-speake.webp') }}"
                        alt="Europe Revival 2026"
                        class="w-full aspect-video object-cover">
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center">
                        {{-- Inactive play button --}}
                        <div class="w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/20 mb-5">
                            <svg class="w-8 h-8 text-white/30 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                        {{-- Coming Soon label --}}
                        <div class="px-5 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full">
                            <p class="text-white font-semibold text-sm tracking-wider uppercase">Coming Soon</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Original video thumbnail (restore when promo video is ready):
            <div class="relative max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50 cursor-pointer group"
                    @click="$dispatch('open-video-modal')">
                    <img src="{{ Vite::asset('resources/images/close-up-of-podium-with-speake.webp') }}"
                        alt="Europe Revival 2026 Highlights"
                        class="w-full aspect-video object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-colors">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/40 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-linear-to-t from-black/80 to-transparent">
                        <p class="text-white/80 text-sm">Watch highlights from Europe Revival 2026</p>
                    </div>
                </div>
            </div>
            --}}

        </div>
    </section>

    {{-- Texture Transition --}}
    <div class="h-24 bg-linear-to-b from-navy-950 to-navy-800 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20"
            style="background-image: url('{{ Vite::asset('resources/images/textures/noise.png') }}'); background-repeat: repeat;">
        </div>
    </div>

    {{-- ============================================
    SPEAKERS SECTION
============================================= --}}
    <section id="speakers" class="py-24 bg-navy-800 relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5"
            style="background-image: url('{{ Vite::asset('resources/images/textures/noise.png') }}');"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span
                    class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                    Featured Speakers
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Speakers</h2>
                <p class="text-white/50 text-lg max-w-2xl mx-auto">
                    Missionaries & ministers who carry revival in different nations around the world, sharing deep messages of love, hope and power of God.
                </p>
            </div>

            {{-- Speakers Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach ($featuredSpeakers as $speaker)
                    <x-home.speaker-card :speaker="$speaker" wire:key="speaker-{{ $speaker->id }}" />
                @endforeach

                {{-- More Coming --}}
                <x-home.more-speakers-card />
            </div>

            {{-- Worship Teams --}}
            @if ($worshipTeams->isNotEmpty())
                <div class="mt-24">
                    <h3 class="text-4xl md:text-5xl font-bold text-white text-center mb-8">Worship Teams</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                        @foreach ($worshipTeams as $speaker)
                            <x-home.speaker-card :speaker="$speaker" :showArrow="false" wire:key="worship-{{ $speaker->id }}" />
                        @endforeach
                        <x-home.more-speakers-card />
                    </div>
                </div>
            @endif

            {{-- Workshop Leaders --}}
            @if ($workshopLeaders->isNotEmpty())
                <div class="mt-24">
                    <h3 class="text-4xl md:text-5xl font-bold text-white text-center mb-4">Workshop Leaders</h3>
                    <p class="text-white/50 text-lg text-center max-w-2xl mx-auto mb-8">
                        Reserve your spot at the workshops! Inspiring talks and hands-on experiences await you.
                    </p>
                    {{-- Workshop Leaders grid with inline "more" link --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-[1fr_1fr_1fr_1fr_auto] gap-4 md:gap-6">
                        @foreach ($workshopLeaders as $speaker)
                            <div wire:key="workshop-{{ $speaker->id }}">
                                <x-home.speaker-card :speaker="$speaker" :showArrow="false" :workshopTopic="$speaker->workshops->first()?->title" />
                            </div>
                        @endforeach
                        <a href="{{ route('workshops') }}" class="sm:col-span-2 md:col-span-1 md:w-36 flex flex-col items-center justify-center group py-6 md:py-0">
                            <div class="w-16 h-16 bg-primary-500/20 rounded-full flex items-center justify-center mb-4 group-hover:bg-primary-500/30 transition-colors">
                                <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <span class="text-primary-400 font-semibold">More Coming</span>
                            <span class="text-white/50 text-sm mt-1">View All</span>
                        </a>
                    </div>

                    {{-- Original carousel version
                    <div class="relative md:-mr-40">
                        <div class="overflow-x-auto md:pr-40 snap-x snap-mandatory scrollbar-hide pb-4 -mb-4">
                            <div class="flex gap-4 md:gap-6">
                                @foreach ($workshopLeaders as $speaker)
                                    <div class="w-[calc(50%-8px)] md:w-[calc(25%-18px)] shrink-0 snap-start"
                                        wire:key="workshop-{{ $speaker->id }}">
                                        <x-home.speaker-card :speaker="$speaker" :showArrow="false" :workshopTopic="$speaker->workshops->first()?->title" />
                                    </div>
                                @endforeach
                                <div class="w-[calc(50%-8px)] md:w-[calc(25%-18px)] shrink-0 snap-start">
                                    <x-home.more-speakers-card />
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute right-0 top-0 bottom-4 w-16 md:w-20 bg-linear-to-l from-navy-800 to-transparent pointer-events-none z-10">
                        </div>
                    </div>
                    --}}

                    {{-- Workshop Sign-up CTA --}}
                    <div class="mt-10 text-center">
                        <a href="{{ route('workshops') }}"
                           class="btn-primary inline-flex items-center gap-2 px-8 py-4 text-lg rounded-full">
                            Sign up now to secure your spot!
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ============================================
    THEME SECTION
============================================= --}}
    <section id="theme" class="py-24 bg-navy-900 relative overflow-hidden">
        {{-- Background Artwork --}}
        <div class="absolute right-0 top-0 w-1/2 h-full opacity-20">
            <img src="{{ Vite::asset('resources/images/encounter-jesus.webp') }}" alt=""
                class="w-full h-full object-cover object-left">
            <div class="absolute inset-0 bg-linear-to-r from-navy-950 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                {{-- Left: Artwork --}}
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ Vite::asset('resources/images/encounter-jesus.webp') }}" alt="Encounter Jesus"
                            class="w-full aspect-4/5 object-cover">
                        {{-- Glow Effect --}}
                        <div class="absolute -inset-4 bg-primary-500/20 blur-3xl -z-10"></div>
                    </div>
                </div>

                {{-- Right: Content --}}
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Encounter Jesus.<br>
                        <span class="text-gradient">Catch on Fire.</span>
                    </h2>
                    <p class="text-white/60 text-lg mb-8 leading-relaxed">
                        We are a movement of hungry, laid-down lovers of Jesus who long to live out revival and see it sweep across Europe.
                        We burn with passion for Jesus and carry the Gospel to the lost — a message of redemption, restoration, love, and
                        power. Be part of what God is doing in Europe through <strong class="text-white/80">Europe Revival 2026</strong>!
                    </p>

                    {{-- Theme Points --}}
                    <div class="space-y-6 mb-10">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-sky-400/20 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-sky-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold mb-1">Deep Worship & Prayer</h4>
                                <p class="text-white/50 text-sm">Join powerful worship and prayer sessions creating space for deep encounters with God and hearing His voice.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-sky-400/20 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-sky-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold mb-1">Ministry & Inspiration</h4>
                                <p class="text-white/50 text-sm">Hear from amazing speakers walking closely with God and receive fresh anointing and breakthrough for your personal walk with Lord Jesus.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-sky-400/20 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-sky-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold mb-1">Outreaches & Missions</h4>
                                <p class="text-white/50 text-sm">Be commissioned to live for the gospel and join the worldwide missions movement that seeks to bring love, hope and power of Jesus to the lost and the broken.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Scripture --}}
                    <blockquote class="bg-primary-500/5 border border-primary-500/20 rounded-xl px-6 py-5">
                        <p class="text-white italic text-lg mb-2">"What no eye has seen, what no ear has heard, and what no human mind has conceived — the things God has prepared for those who love him."</p>
                        <cite class="text-primary-400 text-sm font-medium">— 1 Corinthians 2:9</cite>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    SCHEDULE SECTION
============================================= --}}
    <section id="schedule" class="py-24 bg-navy-800 relative" x-data="{ activeTab: 'main' }">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span
                    class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                    Event Schedule
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">3 Days of Encounter</h2>
                <p class="text-white/50 text-lg max-w-2xl mx-auto">
                    Powerful sessions, inspirational workshops, healing & prophetic rooms, time of fellowship and divine appointments for the Kingdom of God to grow in Europe!
                </p>
            </div>

            @if ($scheduleDays->isNotEmpty())
                @php
                    $trainingDay = $scheduleDays->first(fn($day) => $day['is_training_day']);
                    $mainDays = $scheduleDays->filter(fn($day) => !$day['is_training_day']);
                @endphp

                {{-- Tab Buttons --}}
                <div class="flex justify-center gap-2 mb-12 flex-wrap">
                    @if ($trainingDay)
                        <button @click="activeTab = 'training'"
                            :class="activeTab === 'training' ? 'bg-primary-500 text-navy-800' :
                                'bg-navy-700 text-white/70 hover:text-white'"
                            class="px-6 py-3 rounded-full font-semibold transition-all">
                            Training Day ({{ \Carbon\Carbon::parse($trainingDay['date'])->format('M j') }})
                        </button>
                    @endif
                    <button @click="activeTab = 'main'"
                        :class="activeTab === 'main' ? 'bg-primary-500 text-navy-800' :
                            'bg-navy-700 text-white/70 hover:text-white'"
                        class="px-6 py-3 rounded-full font-semibold transition-all">
                        Main Conference (Oct 23-25)
                    </button>
                </div>

                {{-- Training Day Schedule --}}
                @if ($trainingDay)
                    <div x-show="activeTab === 'training'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="max-w-3xl mx-auto">
                            <div class="bg-navy-700/50 border border-navy-600 rounded-2xl p-8">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-14 h-14 bg-sky-400/20 rounded-xl flex items-center justify-center">
                                        <svg class="w-7 h-7 text-sky-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-white">Ministry Team Training Day</h3>
                                        <p class="text-white/50">{{ $trainingDay['formatted_date'] }} · 10:00am–5:00pm</p>
                                        <p class="text-white/40 text-sm">Speaker: David Gava & Ministry team leaders</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    @foreach ($trainingDay['items'] as $item)
                                        <div class="flex gap-4 p-4 bg-navy-600/30 rounded-xl">
                                            <span class="text-sky-400 font-semibold w-28 shrink-0">
                                                {{ \Carbon\Carbon::parse($item->start_time)->format('g:ia') }}–{{ \Carbon\Carbon::parse($item->end_time)->format('g:ia') }}
                                            </span>
                                            <div>
                                                <h4 class="text-white font-medium">{{ $item->title }}</h4>
                                                @if ($item->description)
                                                    <p class="text-white/50 text-sm">{{ $item->description }}</p>
                                                @endif
                                                @if ($item->speaker)
                                                    <p class="text-sky-400/70 text-sm mt-1">with
                                                        {{ $item->speaker->name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 p-4 bg-orange-500/15 border border-orange-500/30 rounded-xl space-y-2">
                                    <p class="text-orange-400 text-sm">
                                        <strong>Who can attend:</strong> The Training Day is exclusively for registered volunteers who have received an acceptance confirmation, and approved Ministry Team members.
                                    </p>
                                    {{-- <p class="text-orange-400 text-sm">
                                        <strong>Venue:</strong> The Training Day is NOT held at BOK Csarnok. Participants will receive the exact venue details by email.
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Main Conference Schedule --}}
                <div x-show="activeTab === 'main'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach ($mainDays->take(3) as $day)
                            <div class="bg-navy-700/50 border border-navy-600 rounded-2xl overflow-hidden">
                                <div class="bg-navy-600 px-6 py-4">
                                    <span class="text-white/70 text-sm font-medium">Day
                                        {{ $loop->iteration }}</span>
                                    <h3 class="text-white text-xl font-bold">{{ $day['formatted_date'] }}</h3>
                                </div>
                                <div class="p-6 space-y-4">
                                    @foreach ($day['items'] as $item)
                                        @php
                                            $borderColor = match ($item->type) {
                                                'worship' => 'border-sky-400',
                                                'session' => 'border-ocean-500',
                                                'meal' => 'border-navy-400',
                                                'break' => 'border-navy-500',
                                                'special' => 'border-sky-700',
                                                default => 'border-ocean-500',
                                            };
                                            $textColor = match ($item->type) {
                                                'worship' => 'text-sky-400',
                                                'session' => 'text-ocean-500',
                                                'meal' => 'text-navy-300',
                                                'break' => 'text-navy-400',
                                                'special' => 'text-sky-600',
                                                default => 'text-ocean-500',
                                            };
                                        @endphp
                                        <div class="border-l-2 {{ $borderColor }} pl-4">
                                            <span class="{{ $textColor }} text-sm font-semibold">
                                                {{ \Carbon\Carbon::parse($item->start_time)->format('g:ia') }} -
                                                {{ \Carbon\Carbon::parse($item->end_time)->format('g:ia') }}
                                            </span>
                                            <h4 class="text-white font-medium">{{ $item->title }}</h4>
                                            @if ($item->speaker)
                                                <p class="text-white/50 text-sm">{{ $item->speaker->name }}</p>
                                            @elseif($item->description)
                                                <p class="text-white/50 text-sm">{{ $item->description }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('program') }}" class="btn-secondary">
                            View Event Program
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @else
                {{-- Empty State - No Schedule Yet --}}
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-primary-500/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-primary-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Full Schedule Coming Soon</h3>
                    <p class="text-white/50 max-w-md mx-auto mb-8">
                        We're finalizing the conference program. Subscribe to our newsletter to be the first to know
                        when it's released.
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
    @php
        $prices = [
            'early' => [
                '1day' => $ticketPrices['early']['1day'] ?? 29,
                '3day' => $ticketPrices['early']['3day'] ?? 49,
                'group' => $ticketPrices['early']['group'] ?? 39,
            ],
            'regular' => [
                '1day' => $ticketPrices['regular']['1day'] ?? 39,
                '3day' => $ticketPrices['regular']['3day'] ?? 69,
                'group' => $ticketPrices['regular']['group'] ?? 59,
            ],
        ];
    @endphp
    <section id="pricing" class="py-24 bg-navy-900 relative" x-data="{
        activeTier: 'early',
        prices: {{ Js::from($prices) }}
    }">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-6">
                <span
                    class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                    Tickets now available
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Save Your Place</h2>
            </div>

            {{-- Early Bird Deadline Highlight --}}
            <div class="text-center mb-12">
                <span
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-500/15 border border-orange-500/30 rounded-full text-orange-400 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Early Bird price available until June 30, 2026
                </span>
            </div>

            {{-- Pricing Toggle --}}
            <div class="flex justify-center gap-2 mb-12">
                <button type="button"
                    @click="let y = window.scrollY; activeTier = 'early'; $nextTick(() => window.scrollTo({ top: y, behavior: 'instant' }))"
                    :class="activeTier === 'early' ? 'bg-sky-400 text-navy-800' :
                        'bg-navy-700 text-white/70 hover:text-white'"
                    class="px-5 py-2.5 rounded-full font-medium text-sm transition-colors flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full"
                        :class="activeTier === 'early' ? 'bg-navy-800' : 'bg-sky-400'"></span>
                    Early Bird (until June 30)
                </button>
                <button type="button"
                    @click="let y = window.scrollY; activeTier = 'regular'; $nextTick(() => window.scrollTo({ top: y, behavior: 'instant' }))"
                    :class="activeTier === 'regular' ? 'bg-sky-400 text-navy-800' :
                        'bg-navy-700 text-white/70 hover:text-white'"
                    class="px-5 py-2.5 rounded-full font-medium text-sm transition-colors flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full"
                        :class="activeTier === 'regular' ? 'bg-navy-800' : 'bg-sky-400'"></span>
                    Regular (July 1+)
                </button>
            </div>

            {{-- Pricing Cards --}}
            <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                {{-- 1-Day Pass --}}
                <div
                    class="bg-navy-800/50 border border-navy-600 rounded-3xl p-8 relative overflow-hidden flex flex-col">
                    <h3 class="text-2xl font-bold text-white mb-2">1-Day Pass</h3>
                    <p class="text-white/50 mb-6">Single day access</p>

                    <div class="mb-8 grow">
                        <span class="text-5xl font-bold text-white">€<span
                                x-text="prices[activeTier]['1day']">{{ $prices['early']['1day'] }}</span></span>
                        <span class="text-white/50">/person</span>
                    </div>

                    <a href="{{ route('register') }}?ticket=1day" class="btn-primary w-full justify-center">
                        Register Now
                    </a>
                </div>

                {{-- 3-Day Pass --}}
                <div
                    class="bg-linear-to-br from-primary-500/10 to-primary-600/10 border-2 border-primary-500/50 rounded-3xl p-8 relative overflow-hidden flex flex-col">
                    {{-- Best Value Badge --}}
                    <div class="absolute -top-px -right-px">
                        <div
                            class="bg-linear-to-r from-primary-500 to-primary-600 text-navy-800 text-xs font-bold px-4 py-1.5 rounded-bl-xl rounded-tr-3xl">
                            BEST VALUE
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-white mb-2">3-Day Pass</h3>
                    <p class="text-white/50 mb-6">Full event access</p>

                    <div class="mb-8 grow">
                        <span class="text-5xl font-bold text-primary-400">€<span
                                x-text="prices[activeTier]['3day']">{{ $prices['early']['3day'] }}</span></span>
                        <span class="text-white/50">/person</span>
                    </div>

                    <a href="{{ route('register') }}?ticket=3day" class="btn-primary w-full justify-center">
                        Register Now
                    </a>
                </div>

                {{-- Group Ticket --}}
                <div
                    class="bg-navy-800/50 border border-navy-600 rounded-3xl p-8 relative overflow-hidden flex flex-col">
                    <h3 class="text-2xl font-bold text-white mb-2">Group Ticket</h3>
                    <p class="text-white/50 mb-6">Groups of 10+ attendees</p>

                    <div class="mb-8 grow">
                        <span class="text-5xl font-bold text-white">€<span
                                x-text="prices[activeTier]['group']">{{ $prices['early']['group'] }}</span></span>
                        <span class="text-white/50">/person</span>
                    </div>

                    <a href="{{ route('register') }}?ticket=group" class="btn-primary w-full justify-center">
                        Register Now
                    </a>
                </div>
            </div>

            {{-- Coupon Code Note --}}
            <div class="text-center mt-8">
                <p class="text-white/40 text-sm">
                    If you are attending as a volunteer, enter the coupon code from your email during registration.
                </p>
            </div>

        </div>
    </section>

    {{-- ============================================
    VOLUNTEER CTA SECTION
============================================= --}}
    <section class="py-20 bg-navy-900 relative overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/crowd-3.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-15">
            <div class="absolute inset-0 bg-linear-to-r from-primary-600/20 to-navy-900/95"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4">
            <div class="text-center">
                <div
                    class="w-20 h-20 bg-primary-500/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-primary-500/30">
                    <svg class="w-10 h-10 text-primary-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Serve with us!</h2>
                <p class="text-white/60 text-lg max-w-2xl mx-auto mb-4">
                    Be a part of what God is doing in Hungary and in Europe &amp; sign up to volunteer at the event.
                    You can choose to serve in:
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3 mb-6 max-w-2xl mx-auto">
                    @foreach (['Childcare', 'Ushers', 'Registration', 'Merch', 'Hospitality', 'Tech & Media', 'Street Evangelism', 'Kids Ministry'] as $role)
                        <span
                            class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-white/70 text-sm">{{ $role }}</span>
                    @endforeach
                </div>

                <p class="text-primary-400 font-semibold text-lg mb-8">All volunteers receive a 20% discount on the ticket and a free event t-shirt.</p>

                <a href="{{ route('volunteer') }}"
                    class="group inline-flex items-center gap-3 px-10 py-5 bg-linear-to-r from-primary-400 to-primary-600 hover:from-primary-500 hover:to-primary-700 text-navy-900 font-bold text-xl rounded-full transition-all duration-300 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:scale-105">
                    Apply to Volunteer
                    <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================
    SPONSORS SECTION
============================================= --}}
    <section class="py-24 bg-navy-800">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Main Partner --}}
            @if ($mainSponsor)
                <div class="text-center mb-16">
                    <span class="text-white/40 text-sm uppercase tracking-wider mb-4 block">Presented by</span>
                    <x-home.sponsor-logo :sponsor="$mainSponsor" size="main" />
                </div>
            @endif

            {{-- Partners Grid --}}
            @if ($partnerSponsors->isNotEmpty())
                <div class="text-center mb-8">
                    <span class="text-white/40 text-sm uppercase tracking-wider">Partner Organizations</span>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12 opacity-60">
                    @foreach ($partnerSponsors as $sponsor)
                        <x-home.sponsor-logo :sponsor="$sponsor" wire:key="sponsor-{{ $sponsor->id }}" />
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- ============================================
    FAQ SECTION
============================================= --}}
    <section id="faq" class="py-24 bg-navy-800" x-data="{ openFaq: null }">
        <div class="max-w-3xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span
                    class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                    FAQ
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Questions & Answers</h2>
                <p class="text-white/50 text-lg">Everything you need to know about Europe Revival 2026</p>
            </div>

            {{-- FAQ Accordion --}}
            <div class="space-y-4">
                @foreach ($faqs as $index => $faq)
                    <x-home.faq-item :faq="$faq" :index="$index + 1" wire:key="faq-{{ $faq->id }}">
                        @if ($faq->category === 'volunteer')
                            <a href="{{ route('volunteer') }}"
                                class="inline-flex items-center gap-2 text-primary-400 mt-4 hover:underline">
                                Apply Now
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endif
                        @if ($faq->question === 'Where is the conference held?')
                            <div class="mt-4 rounded-lg overflow-hidden border border-navy-600">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5390.850295325713!2d19.09821737667788!3d47.50111099525572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc907f7887b7%3A0x9617556691dcd6c2!2sBOK%20Sportcsarnok!5e0!3m2!1shu!2sus!4v1771601563751!5m2!1shu!2sus"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300"></iframe>
                            </div>
                        @endif
                    </x-home.faq-item>
                @endforeach
            </div>

            {{-- Contact CTA --}}
            <div class="mt-12 text-center">
                <p class="text-white/50 mb-4">Still have questions?</p>
                <a href="mailto:info@iriseuroperevival.com"
                    class="text-primary-400 hover:text-primary-300 font-medium transition-colors">
                    Contact us at info@iriseuroperevival.com
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================
    FINAL CTA SECTION
============================================= --}}
    <section class="py-32 bg-navy-900 relative overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/crowd-1.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-linear-to-t from-navy-950 via-navy-950/70 to-navy-950"></div>
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('{{ Vite::asset('resources/images/textures/noise.png') }}');"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            {{-- Theme Logo --}}
            <div class="mb-8">
                <img src="{{ Vite::asset('resources/images/encounter-jesus-tagline.webp') }}"
                    alt="Encounter Jesus. Catch on Fire." class="h-16 md:h-20 mx-auto opacity-80">
            </div>

            <h2 class="text-4xl md:text-6xl font-bold text-white mb-4">
                Encounter Jesus.<br>
                <span class="text-gradient">Catch on Fire.</span>
            </h2>
            <p class="text-xl md:text-2xl text-white/70 mb-4 max-w-2xl mx-auto font-medium">
                Revival awaits. Be a part of what God is doing in Europe!
            </p>
            <p class="text-lg text-white/50 mb-10 max-w-2xl mx-auto">
                Don't miss out! Join thousands of believers from across Europe for three days that could change your life forever.
            </p>

            {{-- CTA --}}
            <a href="{{ route('register') }}"
                class="group inline-flex items-center gap-3 px-10 py-5 bg-linear-to-r from-primary-400 to-primary-600 hover:from-primary-500 hover:to-primary-700 text-navy-900 font-bold text-xl rounded-full transition-all duration-300 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:scale-105">
                Register Now
                <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>

            {{-- Date Reminder --}}
            <p class="mt-8 text-white/40">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                October 23-25, 2026 • Budapest, Hungary
            </p>
        </div>
    </section>
</div>
