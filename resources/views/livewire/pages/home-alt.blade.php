<div>
    {{-- ============================================
    HERO SECTION — Split layout inspired by designer mockup
============================================= --}}
    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
        {{-- Background: Deep worship / crowd image with film grain --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/baker-background.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-linear-to-b from-[var(--alt-navy-deeper)]/30 via-transparent to-[var(--alt-navy-deeper)]/70"></div>
            {{-- Film Grain Texture --}}
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('{{ Vite::asset('resources/images/alt-style/backgrounds/film-grain-background.webp') }}'); background-size: cover; mix-blend-mode: overlay;">
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-10 max-w-5xl mx-auto px-4 text-center pt-32 pb-20">
            {{-- Conference Badge --}}
            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-[var(--alt-beige)]/10 backdrop-blur-sm border border-[var(--alt-beige)]/20 rounded-full mb-8 animate-fade-in">
                <span class="w-2 h-2 bg-[var(--alt-gold)] rounded-full animate-pulse"></span>
                <span class="text-[var(--alt-beige)] text-base md:text-lg font-heading font-semibold uppercase tracking-wider">October 23-25, 2026 &bull; Budapest, BOK Hall</span>
            </div>

            {{-- Script accent --}}
            <p class="font-script text-[var(--alt-gold-light)] text-3xl md:text-4xl mb-4 animate-fade-in-up">the nations gather</p>

            {{-- Main Title --}}
            <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
                <h1 class="font-heading text-5xl md:text-7xl font-extrabold uppercase tracking-tight leading-none">
                    <span class="text-[var(--alt-beige)]">Europe</span><br>
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)]">Revival</span>
                </h1>
                <p class="font-script text-[var(--alt-gold-light)] text-4xl md:text-5xl mt-2">Budapest 2026</p>
            </div>

            {{-- Tagline --}}
            <div class="mb-10 animate-fade-in-up" style="animation-delay: 0.15s;">
                <h2 class="font-heading text-2xl md:text-4xl font-bold uppercase tracking-wide text-[var(--alt-beige)]">
                    Deep Worship<br>
                    <span class="text-[var(--alt-gold)]">Inspired Prayer</span>
                </h2>
            </div>

            {{-- Description --}}
            <p class="text-lg md:text-xl text-[var(--alt-beige-muted)] max-w-3xl mx-auto mb-10 animate-fade-in-up"
                style="animation-delay: 0.2s;">
                A three-day gathering to encounter Jesus, fall deeply in love with Him, and be sent to carry His heart for the lost across Europe.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16 animate-fade-in-up"
                style="animation-delay: 0.3s;">
                <button @click="$dispatch('open-registration-modal')"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)] hover:from-[var(--alt-gold-light)] hover:to-[var(--alt-gold)] text-[var(--alt-navy-deeper)] font-heading font-bold text-lg uppercase tracking-wider rounded-full transition-all duration-300 shadow-lg hover:scale-105 cursor-pointer">
                    Register Now
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
                <button @click="$dispatch('open-vision-modal')"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-[var(--alt-beige)]/10 hover:bg-[var(--alt-beige)]/20 backdrop-blur-sm border border-[var(--alt-beige)]/20 text-[var(--alt-beige)] font-heading font-semibold text-lg uppercase tracking-wider rounded-full transition-all duration-300">
                    <span class="w-10 h-10 bg-[var(--alt-beige)]/20 rounded-full flex items-center justify-center group-hover:bg-[var(--alt-beige)]/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                    See the Vision
                </button>
            </div>

            {{-- Promo Video Placeholder --}}
            <div class="relative max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50 border border-[var(--alt-beige)]/10">
                    <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/catch-on-fire.webp') }}"
                        alt="Europe Revival 2026"
                        class="w-full aspect-video object-cover">
                    <div class="absolute inset-0 bg-black/5 flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-[var(--alt-beige)]/10 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-[var(--alt-beige)]/20 mb-5">
                            <svg class="w-8 h-8 text-[var(--alt-beige)]/30 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                        <div class="px-5 py-2 bg-[var(--alt-beige)]/10 backdrop-blur-sm border border-[var(--alt-beige)]/20 rounded-full">
                            <p class="text-[var(--alt-beige)] font-heading font-semibold text-sm tracking-wider uppercase">Coming Soon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Texture Transition --}}
    <div class="h-24 bg-linear-to-b from-[var(--alt-navy-deeper)] to-[var(--alt-navy-dark)] relative overflow-hidden">
        <div class="absolute inset-0 opacity-15"
            style="background-image: url('{{ Vite::asset('resources/images/alt-style/backgrounds/film-grain-background.webp') }}'); background-size: cover; mix-blend-mode: overlay;">
        </div>
    </div>

    {{-- ============================================
    SPEAKERS SECTION
============================================= --}}
    <section id="speakers" class="py-24 bg-[var(--alt-navy-dark)] relative overflow-hidden">
        {{-- Background texture --}}
        <div class="absolute inset-0 opacity-5"
            style="background-image: url('{{ Vite::asset('resources/images/alt-style/backgrounds/film-grain-background.webp') }}'); background-size: cover;"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-[var(--alt-gold)] bg-[var(--alt-gold)]/10 border border-[var(--alt-gold)]/30 rounded-full mb-4">
                    Featured Speakers
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-4">Speakers</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-[var(--alt-gold)] to-transparent mx-auto mb-6"></div>
                <p class="text-[var(--alt-beige-muted)] text-lg max-w-2xl mx-auto">
                    Missionaries & ministers who carry revival in different nations around the world, sharing deep messages of love, hope and power of God.
                </p>
            </div>

            {{-- Speakers Grid (4 columns) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach ($this->featuredSpeakers as $speaker)
                    <x-home.speaker-card-alt :speaker="$speaker" wire:key="speaker-{{ $speaker->id }}" />
                @endforeach
                {{-- Coming Soon placeholder --}}
                <div class="relative overflow-hidden rounded-2xl border border-[var(--alt-beige)]/10 bg-[var(--alt-navy)]/50 flex items-center justify-center" style="aspect-ratio: 1/1;">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-[var(--alt-gold)]/10 rounded-full flex items-center justify-center mx-auto mb-4 border border-[var(--alt-gold)]/20">
                            <svg class="w-8 h-8 text-[var(--alt-gold)]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <p class="font-heading text-lg font-bold uppercase tracking-wide text-[var(--alt-beige)]/40">Coming Soon</p>
                    </div>
                </div>
            </div>

            {{-- Workshop Leaders --}}
            @if ($this->workshopLeaders->isNotEmpty())
                <div class="mt-24">
                    <h3 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-[var(--alt-beige)] text-center mb-4">Workshop Leaders</h3>
                    <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-[var(--alt-gold)] to-transparent mx-auto mb-6"></div>
                    <p class="text-[var(--alt-beige-muted)] text-lg text-center max-w-3xl mx-auto mb-8">
                        Reserve your spot at the workshops. Inspiring talks and hands-on activations from global leaders with years of experience in ministry, marketplace, social-justice and arts background.
                    </p>
                    @php
                        $altWorkshopSlugs = ['mary-pat-gokee', 'katey-maddux', 'tineke-bouwman'];
                        $altWorkshopLeaders = $this->workshopLeaders->filter(fn ($s) => in_array($s->slug, $altWorkshopSlugs));
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                        @foreach ($altWorkshopLeaders as $speaker)
                            <div wire:key="workshop-{{ $speaker->id }}">
                                <x-home.speaker-card-alt :speaker="$speaker" :showArrow="false" :workshopTopic="$speaker->workshops->first()?->title" />
                            </div>
                        @endforeach
                        {{-- Coming Soon placeholder --}}
                        <div class="relative overflow-hidden rounded-2xl border border-[var(--alt-beige)]/10 bg-[var(--alt-navy)]/50 flex items-center justify-center" style="aspect-ratio: 5/6;">
                            <div class="text-center p-6">
                                <div class="w-16 h-16 bg-[var(--alt-gold)]/10 rounded-full flex items-center justify-center mx-auto mb-4 border border-[var(--alt-gold)]/20">
                                    <svg class="w-8 h-8 text-[var(--alt-gold)]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <p class="font-heading text-lg font-bold uppercase tracking-wide text-[var(--alt-beige)]/40">Coming Soon</p>
                            </div>
                        </div>
                    </div>

                    {{-- Workshop Sign-up CTA --}}
                    <div class="mt-10 text-center">
                        <a href="{{ route('workshops') }}"
                           class="inline-flex items-center gap-2 px-8 py-4 text-lg rounded-full font-heading font-bold uppercase tracking-wider bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)] text-[var(--alt-navy-deeper)] hover:shadow-lg transition-all duration-300 hover:scale-105">
                            Signup Now to Secure Your Spot
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
    WORSHIP BLOCK — Designer's "Deep Worship" image + team cards
============================================= --}}
    <section id="worship" class="py-24 bg-[var(--alt-navy)] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Deep Worship header image (designer provided — has baked-in text) --}}
            <div class="rounded-2xl overflow-hidden shadow-2xl border border-[var(--alt-beige)]/10 mb-12">
                <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/deep-worship-background.webp') }}"
                    alt="Deep Worship — Inspired Prayer"
                    class="w-full object-cover">
            </div>

            {{-- Worship Team Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-3xl mx-auto">
                {{-- Awakening Music --}}
                @if ($this->worshipTeams->isNotEmpty())
                    @php $awakeningTeam = $this->worshipTeams->first(); @endphp
                    <a href="{{ route('speaker.show', $awakeningTeam->slug) }}"
                        class="group relative rounded-2xl overflow-hidden border border-[var(--alt-beige)]/10 bg-[var(--alt-navy-dark)] hover:border-[var(--alt-gold)]/30 transition-all duration-300" style="aspect-ratio: 16/9;">
                        @if ($awakeningTeam->photo_path)
                            <img src="{{ Vite::asset('resources/' . $awakeningTeam->photo_path) }}"
                                alt="{{ $awakeningTeam->name }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-linear-to-t from-[var(--alt-navy-deeper)]/80 to-transparent"></div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <h4 class="font-heading text-xl font-bold uppercase tracking-wide text-[var(--alt-beige)]">{{ $awakeningTeam->name }}</h4>
                            @if ($awakeningTeam->organization)
                                <p class="text-[var(--alt-beige-muted)] text-sm">{{ $awakeningTeam->organization }}</p>
                            @endif
                        </div>
                    </a>
                @endif

                {{-- Coming Soon placeholder --}}
                <div class="relative rounded-2xl overflow-hidden border border-[var(--alt-beige)]/10 bg-[var(--alt-navy-dark)]/50 flex items-center justify-center" style="aspect-ratio: 16/9;">
                    <div class="text-center p-6">
                        <div class="w-14 h-14 bg-[var(--alt-gold)]/10 rounded-full flex items-center justify-center mx-auto mb-3 border border-[var(--alt-gold)]/20">
                            <svg class="w-7 h-7 text-[var(--alt-gold)]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z" />
                            </svg>
                        </div>
                        <p class="font-heading text-lg font-bold uppercase tracking-wide text-[var(--alt-beige)]/40">Coming Soon</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    THEME SECTION — "Encounter Jesus. Catch on Fire."
============================================= --}}
    <section id="theme" class="py-24 relative overflow-hidden">
        {{-- Full background: catch-on-fire image --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/catch-on-fire.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-linear-to-r from-[var(--alt-navy-deeper)]/85 via-[var(--alt-navy-deeper)]/60 to-[var(--alt-navy-deeper)]/40"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-12 items-end">
                <div class="max-w-3xl flex-1">
                    {{-- Script-style heading like the promo video --}}
                    <p class="font-script text-[var(--alt-gold-light)] text-4xl md:text-5xl mb-2">encounter Jesus</p>
                    <h2 class="font-script text-5xl md:text-7xl text-[var(--alt-gold)] mb-8">Catch on fire</h2>

                    <p class="text-[var(--alt-beige)] text-lg md:text-xl mb-8 leading-relaxed">
                        We are a movement of hungry, laid-down lovers of Jesus who long to live out revival and see it sweep across Europe.
                        We burn with passion for Jesus and carry the Gospel to the lost — a message of redemption, restoration, love, and
                        power. Be part of what God is doing in Europe through <strong class="text-[var(--alt-gold)]">Europe Revival 2026</strong>!
                    </p>

                    {{-- Theme Points --}}
                    <div class="space-y-6 mb-10">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-[var(--alt-gold)]/20 rounded-xl flex items-center justify-center shrink-0 border border-[var(--alt-gold)]/30">
                                <svg class="w-6 h-6 text-[var(--alt-gold)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-heading text-[var(--alt-beige)] font-semibold uppercase tracking-wide mb-1">Deep Worship & Prayer</h4>
                                <p class="text-[var(--alt-beige-muted)] text-sm">Join powerful worship and prayer sessions creating space for deep encounters with God and hearing His voice.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-[var(--alt-gold)]/20 rounded-xl flex items-center justify-center shrink-0 border border-[var(--alt-gold)]/30">
                                <svg class="w-6 h-6 text-[var(--alt-gold)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-heading text-[var(--alt-beige)] font-semibold uppercase tracking-wide mb-1">Ministry & Inspiration</h4>
                                <p class="text-[var(--alt-beige-muted)] text-sm">Hear from amazing speakers walking closely with God and receive fresh anointing and breakthrough for your personal walk with Lord Jesus.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-[var(--alt-gold)]/20 rounded-xl flex items-center justify-center shrink-0 border border-[var(--alt-gold)]/30">
                                <svg class="w-6 h-6 text-[var(--alt-gold)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-heading text-[var(--alt-beige)] font-semibold uppercase tracking-wide mb-1">Outreaches & Missions</h4>
                                <p class="text-[var(--alt-beige-muted)] text-sm">Be commissioned to live for the gospel and join the worldwide missions movement that seeks to bring love, hope and power of Jesus to the lost and the broken.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Scripture --}}
                    <blockquote class="bg-black/20 backdrop-blur-sm border border-[var(--alt-gold)]/20 rounded-xl px-6 py-5">
                        <p class="text-[var(--alt-beige)] italic text-lg mb-2">"What no eye has seen, what no ear has heard, and what no human mind has conceived — the things God has prepared for those who love him."</p>
                        <cite class="text-[var(--alt-gold)] text-sm font-heading font-medium uppercase tracking-wider">— 1 Corinthians 2:9</cite>
                    </blockquote>
                </div>

                {{-- Worship crowd image — bottom right --}}
                <div class="hidden md:block w-96 lg:w-[28rem] xl:w-[32rem] shrink-0">
                    <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/worship-unsplash.webp') }}" alt="Worship crowd"
                        class="w-full rounded-2xl border border-[var(--alt-gold)]/20 shadow-2xl shadow-black/30">
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    SCHEDULE SECTION
============================================= --}}
    <section id="schedule" class="py-24 relative overflow-hidden" x-data="{ activeTab: 'main' }">
        {{-- Background: open-up (triumphal arch) --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/open-up.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover object-top">
            <div class="absolute inset-0 bg-[var(--alt-navy-dark)]/80"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-[var(--alt-gold)] bg-[var(--alt-gold)]/10 border border-[var(--alt-gold)]/30 rounded-full mb-4">
                    Event Schedule
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-4">3 Days of Encounter</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-[var(--alt-gold)] to-transparent mx-auto mb-6"></div>
                <p class="text-[var(--alt-beige)] text-lg max-w-2xl mx-auto px-6 py-4 bg-black/30 backdrop-blur-sm rounded-xl">
                    Powerful sessions, inspirational workshops, healing & prophetic rooms, time of fellowship and divine appointments for the Kingdom of God to grow in Europe!
                </p>
            </div>

            @if ($this->scheduleDays->isNotEmpty())
                @php
                    $trainingDay = $this->scheduleDays->first(fn($day) => $day['is_training_day']);
                    $mainDays = $this->scheduleDays->filter(fn($day) => !$day['is_training_day']);
                @endphp

                {{-- Tab Buttons --}}
                <div class="flex justify-center gap-2 mb-12 flex-wrap">
                    @if ($trainingDay)
                        <button @click="activeTab = 'training'"
                            :class="activeTab === 'training' ? 'bg-[var(--alt-gold)] text-[var(--alt-navy-deeper)]' : 'bg-[var(--alt-navy)] text-[var(--alt-beige-muted)] hover:text-[var(--alt-beige)]'"
                            class="px-6 py-3 rounded-full font-heading font-semibold uppercase tracking-wider text-sm transition-all">
                            Training Day ({{ \Carbon\Carbon::parse($trainingDay['date'])->format('M j') }})
                        </button>
                    @endif
                    <button @click="activeTab = 'main'"
                        :class="activeTab === 'main' ? 'bg-[var(--alt-gold)] text-[var(--alt-navy-deeper)]' : 'bg-[var(--alt-navy)] text-[var(--alt-beige-muted)] hover:text-[var(--alt-beige)]'"
                        class="px-6 py-3 rounded-full font-heading font-semibold uppercase tracking-wider text-sm transition-all">
                        Main Conference (Oct 23-25)
                    </button>
                </div>

                {{-- Training Day Schedule --}}
                @if ($trainingDay)
                    <div x-show="activeTab === 'training'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="max-w-3xl mx-auto">
                            <div class="bg-[var(--alt-navy)]/50 border border-[var(--alt-beige)]/10 rounded-2xl p-8">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-14 h-14 bg-[var(--alt-gold)]/20 rounded-xl flex items-center justify-center border border-[var(--alt-gold)]/30">
                                        <svg class="w-7 h-7 text-[var(--alt-gold)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-[var(--alt-beige)]">Ministry Team Training Day</h3>
                                        <p class="text-[var(--alt-beige-muted)]">{{ $trainingDay['formatted_date'] }} &middot; 10:00am–5:00pm</p>
                                        <p class="text-[var(--alt-beige-muted)]/60 text-sm">Speaker: David Gava & Ministry team leaders</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    @foreach ($trainingDay['items'] as $item)
                                        <div class="flex gap-4 p-4 bg-[var(--alt-navy-deeper)]/30 rounded-xl">
                                            <span class="text-[var(--alt-gold)] font-heading font-semibold w-28 shrink-0">
                                                {{ \Carbon\Carbon::parse($item->start_time)->format('g:ia') }}–{{ \Carbon\Carbon::parse($item->end_time)->format('g:ia') }}
                                            </span>
                                            <div>
                                                <h4 class="text-[var(--alt-beige)] font-medium">{{ $item->title }}</h4>
                                                @if ($item->description)
                                                    <p class="text-[var(--alt-beige-muted)] text-sm">{{ $item->description }}</p>
                                                @endif
                                                @if ($item->speaker)
                                                    <p class="text-[var(--alt-gold)]/70 text-sm mt-1">with {{ $item->speaker->name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 p-4 bg-orange-500/15 border border-orange-500/30 rounded-xl space-y-2">
                                    <p class="text-orange-400 text-sm">
                                        <strong>Who can attend:</strong> The Training Day is exclusively for registered volunteers who have received an acceptance confirmation, and approved Ministry Team members.
                                    </p>
                                    <p class="text-orange-400 text-sm">
                                        <strong>Venue:</strong> The Training Day is NOT held at BOK Csarnok. Participants will receive the exact venue details by email.
                                    </p>
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
                            <div class="bg-[var(--alt-navy)]/50 border border-[var(--alt-beige)]/10 rounded-2xl overflow-hidden">
                                <div class="bg-[var(--alt-navy)] px-6 py-4 border-b border-[var(--alt-beige)]/10">
                                    <span class="text-[var(--alt-beige-muted)] text-sm font-heading font-medium uppercase tracking-wider">Day {{ $loop->iteration }}</span>
                                    <h3 class="text-[var(--alt-beige)] text-xl font-heading font-bold">{{ $day['formatted_date'] }}</h3>
                                </div>
                                <div class="p-6 space-y-4">
                                    @foreach ($day['items'] as $item)
                                        @php
                                            $borderColor = match ($item->type) {
                                                'worship' => 'border-[var(--alt-gold)]',
                                                'session' => 'border-[var(--alt-gold-light)]',
                                                'meal' => 'border-[var(--alt-beige-muted)]',
                                                'break' => 'border-[var(--alt-beige-muted)]/50',
                                                'special' => 'border-[var(--alt-gold)]',
                                                default => 'border-[var(--alt-gold-light)]',
                                            };
                                            $textColor = match ($item->type) {
                                                'worship' => 'text-[var(--alt-gold)]',
                                                'session' => 'text-[var(--alt-gold-light)]',
                                                'meal' => 'text-[var(--alt-beige-muted)]',
                                                'break' => 'text-[var(--alt-beige-muted)]/70',
                                                'special' => 'text-[var(--alt-gold)]',
                                                default => 'text-[var(--alt-gold-light)]',
                                            };
                                        @endphp
                                        <div class="border-l-2 {{ $borderColor }} pl-4">
                                            <span class="{{ $textColor }} text-sm font-heading font-semibold">
                                                {{ \Carbon\Carbon::parse($item->start_time)->format('g:ia') }} -
                                                {{ \Carbon\Carbon::parse($item->end_time)->format('g:ia') }}
                                            </span>
                                            <h4 class="text-[var(--alt-beige)] font-medium">{{ $item->title }}</h4>
                                            @if ($item->speaker)
                                                <p class="text-[var(--alt-beige-muted)] text-sm">{{ $item->speaker->name }}</p>
                                            @elseif($item->description)
                                                <p class="text-[var(--alt-beige-muted)] text-sm">{{ $item->description }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('program') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-transparent border-2 border-[var(--alt-gold)]/30 hover:border-[var(--alt-gold)]/60 hover:bg-[var(--alt-gold)]/5 text-[var(--alt-beige)] font-heading font-semibold uppercase tracking-wider rounded-full transition-all duration-300">
                            View Event Program
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-[var(--alt-gold)]/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-[var(--alt-gold)]/30">
                        <svg class="w-10 h-10 text-[var(--alt-gold)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-3">Full Schedule Coming Soon</h3>
                    <p class="text-[var(--alt-beige-muted)] max-w-md mx-auto mb-8">
                        We're finalizing the conference program. Subscribe to our newsletter to be the first to know when it's released.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <button @click="$dispatch('open-registration-modal')" class="inline-flex items-center gap-2 px-8 py-4 bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)] text-[var(--alt-navy-deeper)] font-heading font-bold uppercase tracking-wider rounded-full cursor-pointer">Register Now</button>
                        <a href="{{ route('program') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-[var(--alt-gold)]/30 text-[var(--alt-beige)] font-heading font-semibold uppercase tracking-wider rounded-full">Check Program Page</a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ============================================
    PRICING SECTION
============================================= --}}
    <section id="pricing" class="py-24 relative overflow-hidden">
        {{-- Background: Budapest map --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/budapest.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-[var(--alt-navy-deeper)]/85"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-6">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-[var(--alt-gold)] bg-[var(--alt-gold)]/10 border border-[var(--alt-gold)]/30 rounded-full mb-4">
                    Tickets Now Available
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-4">Save Your Place</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-[var(--alt-gold)] to-transparent mx-auto"></div>
            </div>

            {{-- 1-Day Pass Deadline (hidden per client request)
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-500/15 border border-orange-500/30 rounded-full text-orange-400 font-heading font-semibold uppercase tracking-wider text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    1-Day Pass available until June 30, 2026
                </span>
            </div> --}}

            {{-- Registration Coming Soon --}}
            <p class="text-center text-[var(--alt-beige)] text-2xl md:text-3xl font-heading font-semibold">Registration opens soon</p>

            @if(true) {{-- Pricing Cards (temporarily hidden) --}}
            <p class="text-center text-[var(--alt-beige)] text-lg mb-8">How much would you like to donate to support the event?</p>
            <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                {{-- 1-Day Supporter Pass --}}
                <div
                    x-data="{ selected: '20', custom: '', get href() {
                        let url = '{{ route('register') }}?duration=1_day&price=' + this.selected;
                        if (this.selected === 'custom' && this.custom) url += '&amount=' + this.custom;
                        return url;
                    }, get valid() {
                        return this.selected !== 'custom' || (this.custom && parseInt(this.custom) > 40);
                    } }"
                    class="bg-[var(--alt-navy-dark)]/50 border border-[var(--alt-beige)]/10 rounded-3xl p-8 relative overflow-hidden flex flex-col">
                    <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-2">1-Day Supporter Pass</h3>
                    <p class="text-[var(--alt-beige-muted)] mb-6">Single day access</p>

                    <div class="mb-8 grow space-y-2">
                        <button type="button" @click="selected = '20'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === '20' ? 'border-[var(--alt-beige)] bg-[var(--alt-beige)]' : 'border-[var(--alt-beige)]/30 group-hover:border-[var(--alt-beige)]/60'">
                                <span class="w-2 h-2 rounded-full bg-[var(--alt-navy-deeper)]" x-show="selected === '20'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === '20' ? 'text-[var(--alt-beige)]' : 'text-[var(--alt-beige)]/50'">&euro;20</span>
                        </button>
                        <button type="button" @click="selected = '40'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === '40' ? 'border-[var(--alt-beige)] bg-[var(--alt-beige)]' : 'border-[var(--alt-beige)]/30 group-hover:border-[var(--alt-beige)]/60'">
                                <span class="w-2 h-2 rounded-full bg-[var(--alt-navy-deeper)]" x-show="selected === '40'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === '40' ? 'text-[var(--alt-beige)]' : 'text-[var(--alt-beige)]/50'">&euro;40</span>
                        </button>
                        <button type="button" @click="selected = 'custom'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === 'custom' ? 'border-[var(--alt-beige)] bg-[var(--alt-beige)]' : 'border-[var(--alt-beige)]/30 group-hover:border-[var(--alt-beige)]/60'">
                                <span class="w-2 h-2 rounded-full bg-[var(--alt-navy-deeper)]" x-show="selected === 'custom'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === 'custom' ? 'text-[var(--alt-beige)]' : 'text-[var(--alt-beige)]/50'">&euro;41+</span>
                        </button>
                        <div x-show="selected === 'custom'" x-transition class="pt-1">
                            <div class="flex items-center gap-2 bg-[var(--alt-navy)]/50 border border-[var(--alt-beige)]/10 rounded-xl px-3 py-2">
                                <span class="text-[var(--alt-beige-muted)] font-medium">&euro;</span>
                                <input type="number" x-model="custom" min="41" step="1" placeholder="Enter amount"
                                    class="bg-transparent text-[var(--alt-beige)] placeholder-[var(--alt-beige-muted)]/30 w-full outline-none text-lg font-heading font-semibold [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                            </div>
                            <p x-show="custom && parseInt(custom) <= 40" class="text-red-400 text-xs mt-1">Minimum &euro;41</p>
                        </div>
                    </div>

                    <a :href="href" :class="valid ? '' : 'opacity-50 pointer-events-none'" class="inline-flex items-center justify-center w-full gap-2 px-8 py-4 bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)] text-[var(--alt-navy-deeper)] font-heading font-bold uppercase tracking-wider rounded-full transition-all duration-300 hover:scale-[1.02]">
                        Register Now
                    </a>
                </div>

                {{-- 3-Day Supporter Pass --}}
                <div
                    x-data="{ selected: '30', custom: '', get href() {
                        let url = '{{ route('register') }}?duration=3_days&price=' + this.selected;
                        if (this.selected === 'custom' && this.custom) url += '&amount=' + this.custom;
                        return url;
                    }, get valid() {
                        return this.selected !== 'custom' || (this.custom && parseInt(this.custom) > 60);
                    } }"
                    class="bg-linear-to-br from-[var(--alt-gold)]/10 to-[var(--alt-gold-light)]/10 border-2 border-[var(--alt-gold)]/50 rounded-3xl p-8 relative overflow-hidden flex flex-col">
                    <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-2">3-Day Supporter Pass</h3>
                    <p class="text-[var(--alt-beige-muted)] mb-6">Full event access</p>

                    <div class="mb-8 grow space-y-2">
                        <button type="button" @click="selected = '30'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === '30' ? 'border-[var(--alt-gold)] bg-[var(--alt-gold)]' : 'border-[var(--alt-gold)]/30 group-hover:border-[var(--alt-gold)]/60'">
                                <span class="w-2 h-2 rounded-full bg-[var(--alt-navy-deeper)]" x-show="selected === '30'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === '30' ? 'text-[var(--alt-gold)]' : 'text-[var(--alt-gold)]/50'">&euro;30</span>
                        </button>
                        <button type="button" @click="selected = '60'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === '60' ? 'border-[var(--alt-gold)] bg-[var(--alt-gold)]' : 'border-[var(--alt-gold)]/30 group-hover:border-[var(--alt-gold)]/60'">
                                <span class="w-2 h-2 rounded-full bg-[var(--alt-navy-deeper)]" x-show="selected === '60'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === '60' ? 'text-[var(--alt-gold)]' : 'text-[var(--alt-gold)]/50'">&euro;60</span>
                        </button>
                        <button type="button" @click="selected = 'custom'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === 'custom' ? 'border-[var(--alt-gold)] bg-[var(--alt-gold)]' : 'border-[var(--alt-gold)]/30 group-hover:border-[var(--alt-gold)]/60'">
                                <span class="w-2 h-2 rounded-full bg-[var(--alt-navy-deeper)]" x-show="selected === 'custom'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === 'custom' ? 'text-[var(--alt-gold)]' : 'text-[var(--alt-gold)]/50'">&euro;61+</span>
                        </button>
                        <div x-show="selected === 'custom'" x-transition class="pt-1">
                            <div class="flex items-center gap-2 bg-[var(--alt-navy)]/50 border border-[var(--alt-beige)]/10 rounded-xl px-3 py-2">
                                <span class="text-[var(--alt-beige-muted)] font-medium">&euro;</span>
                                <input type="number" x-model="custom" min="61" step="1" placeholder="Enter amount"
                                    class="bg-transparent text-[var(--alt-gold)] placeholder-[var(--alt-gold)]/30 w-full outline-none text-lg font-heading font-semibold [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                            </div>
                            <p x-show="custom && parseInt(custom) <= 60" class="text-red-400 text-xs mt-1">Minimum &euro;61</p>
                        </div>
                    </div>

                    <a :href="href" :class="valid ? '' : 'opacity-50 pointer-events-none'" class="inline-flex items-center justify-center w-full gap-2 px-8 py-4 bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)] text-[var(--alt-navy-deeper)] font-heading font-bold uppercase tracking-wider rounded-full transition-all duration-300 hover:scale-[1.02]">
                        Register Now
                    </a>
                </div>
            </div>

            <div class="text-center mt-8">
                <p class="text-[var(--alt-beige-muted)]/60 text-sm">
                    If you are attending as a volunteer, enter the coupon code from your email during registration.
                </p>
            </div>
            @endif
        </div>
    </section>

    {{-- ============================================
    VOLUNTEER CTA SECTION
============================================= --}}
    <section id="volunteer" class="py-20 relative overflow-hidden">
        {{-- Background: Stadium --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/stadium-background-3.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-[var(--alt-navy-deeper)]/75"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4">
            <div class="text-center">
                <div class="w-20 h-20 bg-[var(--alt-gold)]/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-[var(--alt-gold)]/30">
                    <svg class="w-10 h-10 text-[var(--alt-gold)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-4">Serve With Us!</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-[var(--alt-gold)] to-transparent mx-auto mb-6"></div>
                <p class="text-[var(--alt-beige-muted)] text-lg max-w-2xl mx-auto mb-4">
                    Be a part of what God is doing in Hungary and in Europe &amp; sign up to volunteer at the event.
                    You can choose to serve in:
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3 mb-6 max-w-2xl mx-auto">
                    @foreach (['Childcare', 'Ushers', 'Registration', 'Merch', 'Hospitality', 'Tech & Media', 'Kids Ministry'] as $role)
                        <span class="px-4 py-2 bg-[var(--alt-beige)]/5 border border-[var(--alt-beige)]/10 rounded-full text-[var(--alt-beige-muted)] text-sm">{{ $role }}</span>
                    @endforeach
                </div>

                <p class="text-[var(--alt-gold)] font-heading font-semibold text-lg mb-8">Every volunteer can participate with a discounted supporter ticket and will receive a complimentary event t-shirt.</p>

                <a href="{{ route('volunteer') }}"
                    class="group inline-flex items-center gap-3 px-10 py-5 bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)] hover:from-[var(--alt-gold-light)] hover:to-[var(--alt-gold)] text-[var(--alt-navy-deeper)] font-heading font-bold text-xl uppercase tracking-wider rounded-full transition-all duration-300 shadow-lg hover:scale-105">
                    Apply to Volunteer
                    <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================
    FAQ SECTION
============================================= --}}
    <section id="faq" class="py-24 relative overflow-hidden" x-data="{ openFaq: null }">
        {{-- Background: Liberty Bridge watercolor --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/15258.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-[var(--alt-navy-dark)]/85"></div>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-[var(--alt-gold)] bg-[var(--alt-gold)]/10 border border-[var(--alt-gold)]/30 rounded-full mb-4">
                    FAQ
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-4">Questions & Answers</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-[var(--alt-gold)] to-transparent mx-auto mb-6"></div>
                <p class="text-[var(--alt-beige-muted)] text-lg">Everything you need to know about Europe Revival 2026</p>
            </div>

            {{-- FAQ Accordion --}}
            <div class="space-y-4">
                @foreach ($this->faqs as $index => $faq)
                    <x-home.faq-item :faq="$faq" :index="$index + 1" wire:key="faq-{{ $faq->id }}">
                        @if ($faq->category === 'volunteer')
                            <a href="{{ route('volunteer') }}" class="inline-flex items-center gap-2 text-[var(--alt-gold)] mt-4 hover:underline">
                                Apply Now
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endif
                        @if ($faq->question === 'Where is the conference held?')
                            <div class="mt-4 rounded-lg overflow-hidden border border-[var(--alt-beige)]/10">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5390.850295325713!2d19.09821737667788!3d47.50111099525572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc907f7887b7%3A0x9617556691dcd6c2!2sBOK%20Sportcsarnok!5e0!3m2!1shu!2sus!4v1771601563751!5m2!1shu!2sus"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300 sepia-[.3]"></iframe>
                            </div>
                        @endif
                    </x-home.faq-item>
                @endforeach
            </div>

            {{-- Contact CTA --}}
            <div class="mt-12 text-center">
                <p class="text-[var(--alt-beige-muted)] mb-4">Still have questions?</p>
                <a href="mailto:info@iriseuroperevival.com"
                    class="text-[var(--alt-gold)] hover:text-[var(--alt-gold-light)] font-heading font-medium transition-colors">
                    Contact us at info@iriseuroperevival.com
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================
    FINAL CTA SECTION
============================================= --}}
    <section class="py-32 relative overflow-hidden">
        {{-- Background: crowd-ai --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/crowd-ai.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-[var(--alt-navy-deeper)]/85"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            {{-- Script accent --}}
            <p class="font-script text-[var(--alt-gold-light)] text-3xl md:text-4xl mb-4">the nations gather</p>

            <h2 class="font-heading text-4xl md:text-6xl font-bold uppercase tracking-wide text-[var(--alt-beige)] mb-4">
                Encounter Jesus.<br>
                <span class="text-transparent bg-clip-text bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)]">Catch on Fire.</span>
            </h2>
            <p class="text-xl md:text-2xl text-[var(--alt-beige-muted)] mb-4 max-w-2xl mx-auto font-heading font-medium">
                Revival awaits. Be a part of what God is doing in Europe!
            </p>
            <p class="text-lg text-[var(--alt-beige-muted)]/60 mb-10 max-w-2xl mx-auto">
                Don't miss out! Join thousands of believers from across Europe for three days that could change your life forever.
            </p>

            <button @click="$dispatch('open-registration-modal')"
                class="group inline-flex items-center gap-3 px-10 py-5 bg-linear-to-r from-[var(--alt-gold)] to-[var(--alt-gold-light)] hover:from-[var(--alt-gold-light)] hover:to-[var(--alt-gold)] text-[var(--alt-navy-deeper)] font-heading font-bold text-xl uppercase tracking-wider rounded-full transition-all duration-300 shadow-lg hover:scale-105 cursor-pointer">
                Register Now
                <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </button>

            <p class="mt-8 text-[var(--alt-beige-muted)]/60 font-heading uppercase tracking-wider">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                October 23-25, 2026 &bull; Budapest, BOK Hall, Hungary
            </p>
        </div>
    </section>

    {{-- ============================================
    SPONSORS SECTION
============================================= --}}
    <section class="py-24 bg-[var(--alt-navy-dark)]">
        <div class="max-w-7xl mx-auto px-4">
            @if ($this->mainSponsor)
                <div class="text-center mb-16">
                    <span class="text-[var(--alt-beige-muted)]/60 text-sm font-heading uppercase tracking-[0.2em] mb-4 block">Presented by</span>
                    <x-home.sponsor-logo :sponsor="$this->mainSponsor" size="main" />
                </div>
            @endif

            @if ($this->partnerSponsors->isNotEmpty())
                <div class="text-center mb-8">
                    <span class="text-[var(--alt-beige-muted)]/60 text-sm font-heading uppercase tracking-[0.2em]">Partner Organizations</span>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12 opacity-60">
                    @foreach ($this->partnerSponsors as $sponsor)
                        <x-home.sponsor-logo :sponsor="$sponsor" wire:key="sponsor-{{ $sponsor->id }}" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
