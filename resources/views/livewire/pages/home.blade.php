<div>
    {{-- ============================================
    HERO SECTION — Split layout inspired by designer mockup
============================================= --}}
    <section class="relative min-h-screen overflow-hidden bg-(--alt-beige)">
        {{-- Background: Illustrated Budapest collage --}}
        <div class="absolute inset-0 z-0">
            <picture>
                <source media="(min-width: 768px)" srcset="{{ Vite::asset('resources/images/alt-style/backgrounds/iris-hero-bg.webp') }}">
                <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/iris-hero-bg-mobile.webp') }}" alt=""
                    class="absolute inset-x-0 -top-[4%] w-full h-[107%] object-cover object-top-right mask-[linear-gradient(to_bottom,black_60%,transparent_95%)] md:inset-0 md:-top-[20%] md:h-[120%] md:object-[65%_top] md:mask-none">
            </picture>
            <div class="absolute inset-0 bg-linear-to-b from-(--alt-navy-deeper)/40 from-0% via-(--alt-navy-deeper)/0 via-20% to-transparent to-100%"></div>
            {{-- Film Grain Texture --}}
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('{{ Vite::asset('resources/images/alt-style/backgrounds/film-grain-background.webp') }}'); background-size: cover; mix-blend-mode: overlay;">
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-10 flex flex-col items-center max-w-5xl mx-auto px-4 pt-28 pb-16 text-center">
            {{-- Date & Venue --}}
            <div class="mb-12 animate-fade-in">
                <span class="text-[var(--alt-beige)] text-base md:text-xl font-heading font-semibold uppercase tracking-wider drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]">{{ __('October 23-25, 2026 • Budapest, BOK Hall') }}</span>
            </div>

            {{-- Description --}}
            <p class="text-lg md:text-2xl text-neutral-700 font-bold max-w-3xl mx-auto mb-6 animate-fade-in-up drop-shadow-[0_1px_2px_rgba(255,255,255,0.4)] px-6 py-3 bg-[radial-gradient(ellipse_at_center,rgba(180,140,90,0.55)_0%,rgba(180,140,90,0.3)_45%,transparent_75%)] md:bg-none md:px-0 md:py-0">
                {!! __('A three-day gathering to encounter Jesus, fall deeply in love with Him, and be sent to carry His heart for the lost across Europe.') !!}
            </p>

            {{-- Title Image --}}
            <div class="mb-8 animate-fade-in-up">
                <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/europe-revival-bp-2026.webp') }}"
                    alt="Europe Revival Budapest 2026"
                    class="max-w-md md:max-w-lg lg:max-w-xl w-full mx-auto">
            </div>

            {{-- Hidden h1 for SEO --}}
            <h1 class="sr-only">Europe Revival Budapest 2026</h1>

            {{-- Scripture Verse --}}
            <p class="text-xl md:text-2xl text-neutral-700 font-bold max-w-2xl mx-auto mb-10 animate-fade-in-up drop-shadow-[0_1px_2px_rgba(255,255,255,0.4)] px-6 py-3 bg-[radial-gradient(ellipse_at_center,rgba(180,140,90,0.55)_0%,rgba(180,140,90,0.3)_45%,transparent_75%)] md:bg-none md:px-0 md:py-0">
                {!! __('“No eye has seen, no ear has heard, no mind has imagined what the Lord has prepared for those who love Him.”') !!}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12 animate-fade-in-up"
                style="animation-delay: 0.1s;">
                <a href="{{ route('register') }}"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-[#EE9B14] hover:bg-[#d88b10] text-white font-heading font-bold text-lg uppercase tracking-wider rounded-full transition-all duration-300 shadow-lg hover:scale-105">
                    {{ __('Register Now') }}
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <x-cooltix-button variant="navy" size="md" />
                <button @click="$dispatch('open-vision-modal')"
                    class="group inline-flex items-center gap-3 px-8 py-4 bg-gray-500/10 hover:bg-gray-500/20 backdrop-blur-sm border border-gray-500/20 text-gray-700 md:bg-(--alt-beige)/10 md:hover:bg-(--alt-beige)/20 md:border-(--alt-beige)/20 md:text-gray-700 font-heading font-semibold text-lg uppercase tracking-wider rounded-full transition-all duration-300">
                    <span class="w-10 h-10 bg-gray-500/15 md:bg-(--alt-beige)/20 rounded-full flex items-center justify-center group-hover:bg-gray-500/25 md:group-hover:bg-(--alt-beige)/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                    {{ __('Vision') }}
                </button>
            </div>

            {{-- Promo Video --}}
            <div class="relative max-w-3xl w-full mx-auto animate-fade-in-up" style="animation-delay: 0.2s;"
                x-data="{ playing: false }">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50 border border-(--alt-beige)/10 aspect-video">
                    {{-- Thumbnail --}}
                    <template x-if="!playing">
                        <div class="absolute inset-0 cursor-pointer" @click="playing = true">
                            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/promo-video-cover.webp') }}"
                                alt="Europe Revival 2026"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/5 flex items-center justify-center">
                                <div class="w-20 h-20 bg-(--alt-beige)/10 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-(--alt-beige)/20 hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-(--alt-beige) ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </template>
                    {{-- YouTube Embed --}}
                    <template x-if="playing">
                        <iframe
                            src="https://www.youtube.com/embed/{{ app()->getLocale() === 'hu' ? 'W8-ZfXE2oMs' : 'lyOojZSwY74' }}?autoplay=1&rel=0"
                            class="absolute inset-0 w-full h-full"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </template>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    SPEAKERS SECTION
============================================= --}}
    <section id="speakers" class="py-24 bg-(--alt-navy-dark) relative overflow-hidden">
        {{-- Background texture --}}
        <div class="absolute inset-0 opacity-5"
            style="background-image: url('{{ Vite::asset('resources/images/alt-style/backgrounds/film-grain-background.webp') }}'); background-size: cover;"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-(--alt-gold) bg-(--alt-gold)/10 border border-(--alt-gold)/30 rounded-full mb-4">
                    {{ __('Featured Speakers') }}
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">{{ __('Speakers') }}</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-(--alt-gold) to-transparent mx-auto mb-6"></div>
                <p class="text-(--alt-beige-muted) text-lg max-w-2xl mx-auto">
                    {{ __('Missionaries & ministers who carry revival in different nations around the world, sharing deep messages of love, hope and power of God.') }}
                </p>
            </div>

            {{-- Speakers Grid (1 row of 4) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach ($this->featuredSpeakers as $speaker)
                    <x-home.speaker-card-alt :speaker="$speaker" wire:key="speaker-{{ $speaker->id }}" />
                @endforeach
            </div>

        </div>
    </section>

    {{-- ============================================
    WORSHIP BLOCK — Designer's "Deep Worship" image + team cards
============================================= --}}
    <section id="worship" class="py-24 bg-(--alt-navy) relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Deep Worship header image with title overlay --}}
            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-(--alt-beige)/10 mb-12 h-48 md:h-60 lg:h-72 max-w-3xl mx-auto">
                <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/deep-worship-bg.webp') }}"
                    alt="Deep Worship — Inspired Prayer"
                    class="absolute inset-0 w-full h-full object-cover object-bottom">
                <div class="absolute inset-0 flex items-center justify-center px-8">
                    @if (app()->getLocale() === 'hu')
                        <h2 class="font-heading text-3xl md:text-5xl font-bold uppercase tracking-wide text-(--alt-beige) text-center drop-shadow-lg">
                            Mély dicsőítés
                        </h2>
                    @else
                        <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/deep-worship-title.webp') }}"
                            alt="The nations gather — Deep Worship, Inspired Prayer"
                            class="max-w-56 md:max-w-sm lg:max-w-md w-full">
                    @endif
                </div>
            </div>

            {{-- Worship Team Cards --}}
            @php
                $worshipImages = [
                    'awakening-music' => 'images/alt-style/awakening-worship.webp',
                    'mountain-people-worship' => 'images/alt-style/mountain-people.webp',
                    'iris-europe-worship' => 'images/alt-style/iris-europe-worship.webp',
                ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($this->worshipTeams as $team)
                    <a href="{{ route('speaker.show', $team->slug) }}"
                        class="group relative rounded-2xl overflow-hidden border border-(--alt-beige)/10 bg-(--alt-navy-dark) hover:border-(--alt-gold)/30 transition-all duration-300" style="aspect-ratio: 16/9;">
                        <img src="{{ Vite::asset('resources/' . ($worshipImages[$team->slug] ?? 'images/alt-style/awakening-worship.webp')) }}"
                            alt="{{ $team->name }}"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-linear-to-t from-(--alt-navy-deeper)/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <h4 class="font-heading text-xl font-bold uppercase tracking-wide text-(--alt-beige)">{{ $team->name }}</h4>
                            @if ($team->t('organization'))
                                <p class="text-(--alt-beige-muted) text-sm">{{ $team->t('organization') }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================
    WORKSHOP LEADERS SECTION
============================================= --}}
    @if ($this->workshopLeaders->isNotEmpty())
        <section id="workshops" class="py-24 bg-(--alt-navy-dark) relative overflow-hidden scroll-mt-32">
            <div class="relative z-10 max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h3 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">{{ __('Workshops') }}</h3>
                    <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-(--alt-gold) to-transparent mx-auto mb-6"></div>
                    <p class="text-(--alt-beige-muted) text-lg max-w-3xl mx-auto">
                       {{ __('Inspiring talks and hands-on activations from global leaders with years of experience in ministry, marketplace, social-justice and arts background.') }}
                    </p>
                </div>
                @php
                    $workshopCards = [
                        ['slug' => 'david-gava', 'photo' => 'images/alt-style/workshop-leaders/gava.webp', 'topic' => 'Power Evangelism, Revival Harvest', 'workshop' => ['power-evangelism', 'revival-harvest']],
                        ['slug' => 'mary-pat-gokee', 'photo' => 'images/alt-style/workshop-leaders/gokee.webp', 'topic' => 'Passion, Purpose, Fire', 'workshop' => 'missions'],
                        ['slug' => 'baoyan-lam', 'photo' => 'images/alt-style/workshop-leaders/taslim.webp', 'topic' => 'Marketplace Missions', 'workshop' => 'marketplace-missions'],
                        ['slug' => 'dr-kate', 'photo' => 'images/alt-style/workshop-leaders/kate.webp', 'topic' => 'The Beautiful Heart of Jesus: Set Free Through Creative Movement', 'workshop' => 'prophetic-arts'],
                        ['slug' => 'brian-valerie', 'photo' => 'images/alt-style/workshop-leaders/britton.webp', 'topic' => 'The Burning Generation: Living Like Jesus', 'workshop' => 'father-heart-of-god'],
                        ['slug' => 'tineke-bouwman', 'photo' => 'images/alt-style/workshop-leaders/tineke.webp', 'topic' => 'Prophetic Voice', 'workshop' => 'prophetic-ministry'],
                        ['slug' => 'katey-maddux', 'photo' => 'images/alt-style/workshop-leaders/katey.webp', 'topic' => 'Pioneering in Human Trafficking', 'workshop' => 'human-trafficking-awareness'],
                        ['slug' => 'fernando-sousa', 'photo' => 'images/alt-style/workshop-leaders/sousa.webp', 'topic' => 'Freedom from Homosexuality', 'workshop' => null],
                    ];
                    $workshopSpeakers = \App\Models\Speaker::query()
                        ->whereIn('slug', collect($workshopCards)->pluck('slug'))
                        ->get()
                        ->keyBy('slug');
                    $workshopSlugs = collect($workshopCards)->pluck('workshop')->flatten()->filter();
                    $workshopBySlug = \App\Models\Workshop::query()
                        ->whereIn('slug', $workshopSlugs)
                        ->get()
                        ->keyBy('slug');
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach ($workshopCards as $i => $card)
                        @php
                            $speaker = $workshopSpeakers->get($card['slug']);
                            $cardWorkshopSlugs = (array) ($card['workshop'] ?? []);
                            $cardDescriptions = collect($cardWorkshopSlugs)
                                ->map(fn ($slug) => $workshopBySlug->get($slug)?->t('description'))
                                ->filter()
                                ->implode("\n\n");
                        @endphp
                        @if ($speaker)
                            <div wire:key="workshop-{{ $speaker->id }}" @class(['md:col-start-2' => $i === 8])>
                                <x-home.speaker-card-alt
                                    :speaker="$speaker"
                                    :showArrow="false"
                                    :portraitPath="$card['photo']"
                                    :workshopTopic="__($card['topic'])"
                                    :workshopDescription="$cardDescriptions ?: null" />
                            </div>
                        @endif
                    @endforeach
                    {{-- Coming Soon placeholder --}}
                    <div class="relative overflow-hidden rounded-2xl border border-(--alt-beige)/10 bg-(--alt-navy)/50 flex items-center justify-center" style="aspect-ratio: 5/6;">
                        <div class="text-center p-6">
                            <div class="w-16 h-16 bg-(--alt-gold)/10 rounded-full flex items-center justify-center mx-auto mb-4 border border-(--alt-gold)/20">
                                <svg class="w-8 h-8 text-(--alt-gold)/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <p class="font-heading text-lg font-bold uppercase tracking-wide text-(--alt-beige)/40">{{ __('and more to be announced') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Workshop Sign-up CTA --}}
                <div class="mt-10 text-center">
                    <a href="{{ route('workshops') }}"
                       class="inline-flex items-center gap-2 px-8 py-4 text-lg rounded-full font-heading font-bold uppercase tracking-wider bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) text-(--alt-navy-deeper) hover:shadow-lg transition-all duration-300 hover:scale-105">
                        {{ __('Signup Now to Secure Your Spot') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================
    THEME SECTION — "Encounter Jesus. Catch on Fire."
============================================= --}}
    <section id="theme" class="py-24 relative overflow-hidden">
        {{-- Full background: catch-on-fire image --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/worship-unsplash.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-linear-to-r from-(--alt-navy-deeper)/85 via-(--alt-navy-deeper)/70 to-(--alt-navy-deeper)/50"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    {{-- Script-style heading like the promo video --}}
                    <p class="font-script text-(--alt-gold-light) text-5xl md:text-7xl mb-2">{{ __('encounter Jesus') }}</p>
                    <h2 class="font-script text-6xl md:text-8xl text-(--alt-gold) mb-8">{{ __('Catch on fire') }}</h2>

                    <p class="text-(--alt-beige) text-lg md:text-xl mb-8 leading-relaxed">
                        {{ __('We are a movement of hungry, laid-down lovers of Jesus who long to live out revival and see it sweep across Europe. We burn with passion for Jesus and carry the Gospel to the lost — a message of redemption, restoration, love, and power. Be part of what God is doing in Europe through') }} <strong class="text-(--alt-gold)">Europe Revival 2026</strong>!
                    </p>

                    {{-- Theme Points --}}
                    <div class="space-y-6 mb-10">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-(--alt-gold)/20 rounded-xl flex items-center justify-center shrink-0 border border-(--alt-gold)/30">
                                <svg class="w-6 h-6 text-(--alt-gold)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-heading text-(--alt-beige) font-semibold uppercase tracking-wide mb-1">{{ __('Deep Worship & Prayer') }}</h4>
                                <p class="text-(--alt-beige-muted) text-sm">{{ __('Join powerful worship and prayer sessions creating space for deep encounters with God and hearing His voice.') }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-(--alt-gold)/20 rounded-xl flex items-center justify-center shrink-0 border border-(--alt-gold)/30">
                                <svg class="w-6 h-6 text-(--alt-gold)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-heading text-(--alt-beige) font-semibold uppercase tracking-wide mb-1">{{ __('Ministry & Inspiration') }}</h4>
                                <p class="text-(--alt-beige-muted) text-sm">{{ __('Hear from amazing speakers walking closely with God and receive fresh anointing and breakthrough for your personal walk with Lord Jesus.') }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-(--alt-gold)/20 rounded-xl flex items-center justify-center shrink-0 border border-(--alt-gold)/30">
                                <svg class="w-6 h-6 text-(--alt-gold)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-heading text-(--alt-beige) font-semibold uppercase tracking-wide mb-1">{{ __('Outreaches & Missions') }}</h4>
                                <p class="text-(--alt-beige-muted) text-sm">{{ __('Be commissioned to live for the gospel and join the worldwide missions movement that seeks to bring love, hope and power of Jesus to the lost and the broken.') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Scripture --}}
                    <blockquote class="bg-black/20 backdrop-blur-sm border border-(--alt-gold)/20 rounded-xl px-6 py-5">
                        <p class="text-(--alt-beige) italic text-lg mb-2">{{ __('"What no eye has seen, what no ear has heard, and what no human mind has conceived — the things God has prepared for those who love him."') }}</p>
                        <cite class="text-(--alt-gold) text-sm font-heading font-medium uppercase tracking-wider">{{ __('— 1 Corinthians 2:9') }}</cite>
                    </blockquote>
                </div>

                {{-- Promo Video (same as hero section) --}}
                <div class="relative w-full bg-(--alt-gold)/15 backdrop-blur-sm rounded-3xl p-4 border border-(--alt-gold)/30" x-data="{ playing: false }">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50 aspect-video">
                        {{-- Thumbnail --}}
                        <template x-if="!playing">
                            <div class="absolute inset-0 cursor-pointer" @click="playing = true">
                                <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/promo-video-cover.webp') }}"
                                    alt="Europe Revival 2026"
                                    class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/5 flex items-center justify-center">
                                    <div class="w-20 h-20 bg-(--alt-beige)/10 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-(--alt-beige)/20 hover:scale-110 transition-transform duration-300">
                                        <svg class="w-8 h-8 text-(--alt-beige) ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </template>
                        {{-- YouTube Embed --}}
                        <template x-if="playing">
                            <iframe
                                src="https://www.youtube.com/embed/{{ app()->getLocale() === 'hu' ? 'W8-ZfXE2oMs' : 'lyOojZSwY74' }}?autoplay=1&rel=0"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="autoplay; encrypted-media"
                                allowfullscreen>
                            </iframe>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    SCHEDULE SECTION
============================================= --}}
    <section id="schedule" class="pt-50 pb-16 relative overflow-hidden" x-data="{ activeTab: 'main' }">
        {{-- Background: open-up (triumphal arch) --}}
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/three-days-bg.webp') }}" alt=""
                class="absolute inset-0 w-full object-contain object-top"
                style="mask-image: linear-gradient(to bottom, black 90%, transparent 100%); -webkit-mask-image: linear-gradient(to bottom, black 90%, transparent 100%);">
            <div class="absolute inset-0 bg-(--alt-navy-dark)/80"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-(--alt-gold) bg-(--alt-gold)/10 border border-(--alt-gold)/30 rounded-full mb-4">
                    {{ __('Event Schedule') }}
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">{{ __('3 Days of Encounter') }}</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-(--alt-gold) to-transparent mx-auto mb-6"></div>
                <p class="text-(--alt-beige) text-lg max-w-4xl mx-auto px-6 py-4 bg-black/30 backdrop-blur-sm rounded-xl">
                    {{ __('Powerful sessions, inspirational workshops, healing & prophetic rooms, time of fellowship and divine appointments for the Kingdom of God to grow in Europe!') }}
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
                            :class="activeTab === 'training' ? 'bg-(--alt-gold) text-(--alt-navy-deeper)' : 'bg-(--alt-navy) text-(--alt-beige-muted) hover:text-(--alt-beige)'"
                            class="px-6 py-3 rounded-full font-heading font-semibold uppercase tracking-wider text-sm transition-all">
                            {{ __('Training Day') }} ({{ \Carbon\Carbon::parse($trainingDay['date'])->translatedFormat('M j') }})
                        </button>
                    @endif
                    <button @click="activeTab = 'main'"
                        :class="activeTab === 'main' ? 'bg-(--alt-gold) text-(--alt-navy-deeper)' : 'bg-(--alt-navy) text-(--alt-beige-muted) hover:text-(--alt-beige)'"
                        class="px-6 py-3 rounded-full font-heading font-semibold uppercase tracking-wider text-sm transition-all">
                        {{ __('Main Conference (Oct 23-25)') }}
                    </button>
                </div>

                {{-- Training Day Schedule --}}
                @if ($trainingDay)
                    <div x-show="activeTab === 'training'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="max-w-3xl mx-auto">
                            <div class="bg-(--alt-navy)/50 border border-(--alt-beige)/10 rounded-2xl p-8">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-14 h-14 bg-(--alt-gold)/20 rounded-xl flex items-center justify-center border border-(--alt-gold)/30">
                                        <svg class="w-7 h-7 text-(--alt-gold)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-(--alt-beige)">{{ __('Ministry Team Training Day') }}</h3>
                                        <p class="text-(--alt-beige-muted)">{{ $trainingDay['formatted_date'] }} &middot; 10:00–17:00</p>
                                        <p class="text-(--alt-beige-muted)/60 text-sm">{{ __('Speaker: David Gava & Ministry team leaders') }}</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    @foreach ($trainingDay['items'] as $item)
                                        <div class="flex gap-4 p-4 bg-(--alt-navy-deeper)/30 rounded-xl">
                                            <span class="text-(--alt-gold) font-heading font-semibold w-28 shrink-0">
                                                {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}–{{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                            </span>
                                            <div>
                                                <h4 class="text-(--alt-beige) font-medium">{{ $item->t('title') }}</h4>
                                                @if ($item->t('description'))
                                                    <p class="text-(--alt-beige-muted) text-sm">{{ $item->t('description') }}</p>
                                                @endif
                                                @if ($item->speaker)
                                                    <p class="text-(--alt-gold)/70 text-sm mt-1">with {{ $item->speaker->name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 p-4 bg-orange-500/15 border border-orange-500/30 rounded-xl space-y-2">
                                    <p class="text-orange-400 text-sm">
                                        <strong>{{ __('Who can attend:') }}</strong> {{ __('The Training Day is exclusively for registered volunteers who have received an acceptance confirmation, and approved Ministry Team members.') }}
                                    </p>
                                    <p class="text-orange-400 text-sm">
                                        <strong>{{ __('Venue:') }}</strong> {{ __('The Training Day is NOT held at BOK Csarnok. Participants will receive the exact venue details by email.') }}
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
                            <div class="bg-(--alt-navy)/50 border border-(--alt-beige)/10 rounded-2xl overflow-hidden">
                                <div class="bg-(--alt-navy) px-6 py-4 border-b border-(--alt-beige)/10">
                                    <span class="text-(--alt-beige-muted) text-sm font-heading font-medium uppercase tracking-wider">{{ __('Day') }} {{ $loop->iteration }}</span>
                                    <h3 class="text-(--alt-beige) text-xl font-heading font-bold">{{ $day['formatted_date'] }}</h3>
                                </div>
                                <div class="p-6 space-y-4">
                                    @foreach ($day['items'] as $item)
                                        @php
                                            $borderColor = match ($item->type) {
                                                'worship' => 'border-(--alt-gold)',
                                                'session' => 'border-(--alt-gold-light)',
                                                'meal' => 'border-(--alt-beige-muted)',
                                                'break' => 'border-(--alt-beige-muted)/50',
                                                'special' => 'border-(--alt-gold)',
                                                default => 'border-(--alt-gold-light)',
                                            };
                                            $textColor = match ($item->type) {
                                                'worship' => 'text-(--alt-gold)',
                                                'session' => 'text-(--alt-gold-light)',
                                                'meal' => 'text-(--alt-beige-muted)',
                                                'break' => 'text-(--alt-beige-muted)/70',
                                                'special' => 'text-(--alt-gold)',
                                                default => 'text-(--alt-gold-light)',
                                            };
                                        @endphp
                                        <div class="border-l-2 {{ $borderColor }} pl-4">
                                            <span class="{{ $textColor }} text-sm font-heading font-semibold">
                                                {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                            </span>
                                            <h4 class="text-(--alt-beige) font-medium">{{ $item->t('title') }}</h4>
                                            @if ($item->speaker)
                                                <p class="text-(--alt-beige-muted) text-sm">{{ $item->speaker->name }}</p>
                                            @elseif($item->t('description'))
                                                <p class="text-(--alt-beige-muted) text-sm whitespace-nowrap overflow-hidden"
                                                    x-data="{ fits: true }"
                                                    x-init="fits = $el.scrollWidth <= $el.clientWidth"
                                                    x-show="fits">{{ $item->t('description') }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('program') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-transparent border-2 border-(--alt-gold)/30 hover:border-(--alt-gold)/60 hover:bg-(--alt-gold)/5 text-(--alt-beige) font-heading font-semibold uppercase tracking-wider rounded-full transition-all duration-300">
                            {{ __('View Event Program') }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-(--alt-gold)/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-(--alt-gold)/30">
                        <svg class="w-10 h-10 text-(--alt-gold)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-(--alt-beige) mb-3">Full Schedule Coming Soon</h3>
                    <p class="text-(--alt-beige-muted) max-w-md mx-auto mb-8">
                        We're finalizing the conference program. Subscribe to our newsletter to be the first to know when it's released.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) text-(--alt-navy-deeper) font-heading font-bold uppercase tracking-wider rounded-full">{{ __('Register Now') }}</a>
                        <a href="{{ route('program') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-(--alt-gold)/30 text-(--alt-beige) font-heading font-semibold uppercase tracking-wider rounded-full">Check Program Page</a>
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
                class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-(--alt-navy-deeper)/50"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-6">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-(--alt-gold) bg-(--alt-gold)/10 border border-(--alt-gold)/30 rounded-full mb-4">
                    {{ __('Tickets Now Available') }}
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">{{ __('Save Your Place') }}</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-(--alt-gold) to-transparent mx-auto"></div>
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

            @if(true) {{-- Pricing Cards --}}
            <p class="text-center text-(--alt-beige) text-lg mb-8">{{ __('How much would you like to donate to support the event?') }}</p>
            <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                {{-- 1-Day Pass --}}
                <div
                    x-data="{ selected: '7500', custom: '', get href() {
                        let url = '{{ route('register') }}?duration=1_day&price=' + this.selected;
                        if (this.selected === 'custom' && this.custom) url += '&amount=' + this.custom;
                        return url;
                    }, get valid() {
                        return this.selected !== 'custom' || (this.custom && parseInt(this.custom) > 7500);
                    } }"
                    class="bg-(--alt-navy-dark)/40 border border-(--alt-beige)/15 rounded-3xl p-8 relative overflow-hidden flex flex-col">
                    <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-(--alt-beige) mb-2">{{ __('1-Day Supporter Pass') }}</h3>
                    <p class="text-(--alt-beige-muted) mb-6">{{ __('Single day access') }}</p>

                    <div class="mb-8 grow space-y-2">
                        <button type="button" @click="selected = '7500'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === '7500' ? 'border-(--alt-beige) bg-(--alt-beige)' : 'border-(--alt-beige)/30 group-hover:border-(--alt-beige)/60'">
                                <span class="w-2 h-2 rounded-full bg-(--alt-navy-deeper)" x-show="selected === '7500'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === '7500' ? 'text-(--alt-beige)' : 'text-(--alt-beige)/50'">{{ Number::currency(7500, 'HUF', app()->getLocale(), 0) }} <span class="text-base font-semibold opacity-60">(~€{{ Number::format(round(7500 / 400)) }}) {{ __('/ person') }}</span></span>
                        </button>
                        <button type="button" @click="selected = 'custom'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === 'custom' ? 'border-(--alt-beige) bg-(--alt-beige)' : 'border-(--alt-beige)/30 group-hover:border-(--alt-beige)/60'">
                                <span class="w-2 h-2 rounded-full bg-(--alt-navy-deeper)" x-show="selected === 'custom'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === 'custom' ? 'text-(--alt-beige)' : 'text-(--alt-beige)/50'">{{ __('Custom amount') }}</span>
                        </button>
                        <div x-show="selected === 'custom'" x-transition class="pt-1">
                            <div class="flex items-center gap-2 bg-(--alt-navy)/50 border border-(--alt-beige)/10 rounded-xl px-3 py-2">
                                <input type="number" x-model="custom" min="7501" step="1" placeholder="{{ __('Enter amount') }}"
                                    class="bg-transparent text-(--alt-beige) placeholder-(--alt-beige-muted)/30 w-full outline-none text-lg font-heading font-semibold [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                                <span class="text-(--alt-beige-muted) font-medium shrink-0">HUF</span>
                                <span x-show="custom" class="text-(--alt-beige-muted)/60 text-sm shrink-0" x-text="'(~€' + Math.round(parseInt(custom || 0) / 400) + ')'"></span>
                            </div>
                            <p class="text-(--alt-beige-muted) text-xs mt-1">{{ __('If you would like to support the event with an amount exceeding :amount.', ['amount' => Number::currency(7500, 'HUF', app()->getLocale(), 0)]) }}</p>
                            <p x-show="custom && parseInt(custom) <= 7500" class="text-red-400 text-xs mt-1">{{ __('Minimum :amount', ['amount' => Number::currency(7501, 'HUF', app()->getLocale(), 0)]) }}</p>
                        </div>
                    </div>

                    <a :href="href" :class="valid ? '' : 'opacity-50 pointer-events-none'" class="inline-flex items-center justify-center w-full gap-2 px-8 py-4 bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) text-(--alt-navy-deeper) font-heading font-bold uppercase tracking-wider rounded-full transition-all duration-300 hover:scale-[1.02]">
                        {{ __('Register Now') }}
                    </a>
                </div>

                {{-- 3-Day Pass --}}
                <div
                    x-data="{ selected: '15000', custom: '', get href() {
                        let url = '{{ route('register') }}?duration=3_days&price=' + this.selected;
                        if (this.selected === 'custom' && this.custom) url += '&amount=' + this.custom;
                        return url;
                    }, get valid() {
                        return this.selected !== 'custom' || (this.custom && parseInt(this.custom) > 15000);
                    } }"
                    class="bg-linear-to-br from-(--alt-gold)/15 to-(--alt-navy-dark)/70 border-2 border-(--alt-gold)/40 rounded-3xl p-8 relative overflow-hidden flex flex-col shadow-lg shadow-(--alt-gold)/10">
                    <h3 class="font-heading text-2xl font-bold uppercase tracking-wide text-(--alt-beige) mb-2">{{ __('3-Day Supporter Pass') }}</h3>
                    <p class="text-(--alt-beige-muted) mb-6">{{ __('Full event access') }}</p>

                    <div class="mb-8 grow space-y-2">
                        <button type="button" @click="selected = '15000'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === '15000' ? 'border-(--alt-gold) bg-(--alt-gold)' : 'border-(--alt-gold)/30 group-hover:border-(--alt-gold)/60'">
                                <span class="w-2 h-2 rounded-full bg-(--alt-navy-deeper)" x-show="selected === '15000'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === '15000' ? 'text-(--alt-gold)' : 'text-white/50'">{{ Number::currency(15000, 'HUF', app()->getLocale(), 0) }} <span class="text-base font-semibold opacity-60">(~€{{ Number::format(round(15000 / 400)) }}) {{ __('/ person') }}</span></span>
                        </button>
                        <button type="button" @click="selected = 'custom'" class="flex items-center gap-3 w-full group">
                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
                                :class="selected === 'custom' ? 'border-(--alt-gold) bg-(--alt-gold)' : 'border-(--alt-gold)/30 group-hover:border-(--alt-gold)/60'">
                                <span class="w-2 h-2 rounded-full bg-(--alt-navy-deeper)" x-show="selected === 'custom'"></span>
                            </span>
                            <span class="text-2xl font-heading font-bold transition-colors" :class="selected === 'custom' ? 'text-(--alt-gold)' : 'text-white/50'">{{ __('Custom amount') }}</span>
                        </button>
                        <div x-show="selected === 'custom'" x-transition class="pt-1">
                            <div class="flex items-center gap-2 bg-(--alt-navy)/50 border border-(--alt-beige)/10 rounded-xl px-3 py-2">
                                <input type="number" x-model="custom" min="15001" step="1" placeholder="{{ __('Enter amount') }}"
                                    class="bg-transparent text-(--alt-gold) placeholder-(--alt-gold)/30 w-full outline-none text-lg font-heading font-semibold [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                                <span class="text-(--alt-beige-muted) font-medium shrink-0">HUF</span>
                                <span x-show="custom" class="text-(--alt-beige-muted)/60 text-sm shrink-0" x-text="'(~€' + Math.round(parseInt(custom || 0) / 400) + ')'"></span>
                            </div>
                            <p class="text-(--alt-beige-muted) text-xs mt-1">{{ __('If you would like to support the event with an amount exceeding :amount.', ['amount' => Number::currency(15000, 'HUF', app()->getLocale(), 0)]) }}</p>
                            <p x-show="custom && parseInt(custom) <= 15000" class="text-red-400 text-xs mt-1">{{ __('Minimum :amount', ['amount' => Number::currency(15001, 'HUF', app()->getLocale(), 0)]) }}</p>
                        </div>
                    </div>

                    <a :href="href" :class="valid ? '' : 'opacity-50 pointer-events-none'" class="inline-flex items-center justify-center w-full gap-2 px-8 py-4 bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) text-(--alt-navy-deeper) font-heading font-bold uppercase tracking-wider rounded-full transition-all duration-300 hover:scale-[1.02]">
                        {{ __('Register Now') }}
                    </a>
                </div>
            </div>

            {{-- Cooltix ticket purchase --}}
            <div class="mt-10 text-center">
                <p class="text-(--alt-beige-muted) mb-4">{{ __('You can also buy your ticket through our ticketing partner.') }}</p>
                <x-cooltix-button variant="outline" size="md" />
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
            <div class="absolute inset-0 bg-(--alt-navy-deeper)/75"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4">
            <div class="text-center">
                <div class="w-20 h-20 bg-(--alt-gold)/20 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-(--alt-gold)/30">
                    <svg class="w-10 h-10 text-(--alt-gold)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">{{ __('Serve With Us!') }}</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-(--alt-gold) to-transparent mx-auto mb-6"></div>
                <p class="text-(--alt-beige-muted) text-lg max-w-2xl mx-auto mb-4">
                    {!! __('Be a part of what God is doing in Hungary and in Europe & sign up to volunteer at the event. You can choose to serve in:') !!}
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3 mb-6 max-w-2xl mx-auto">
                    @foreach (['Childcare', 'Ushers', 'Registration', 'Merch', 'Hospitality', 'Tech & Media', 'Translators'] as $role)
                        <span class="px-4 py-2 bg-(--alt-beige)/5 border border-(--alt-beige)/10 rounded-full text-(--alt-beige-muted) text-sm">{{ __($role) }}</span>
                    @endforeach
                </div>

                <p class="text-(--alt-gold) font-heading font-semibold text-lg mb-8">{{ __('Every volunteer can participate with a discounted supporter ticket and will receive a complimentary event t-shirt.') }}</p>

                <a href="{{ route('volunteer') }}"
                    class="group inline-flex items-center gap-3 px-10 py-5 bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) hover:from-(--alt-gold-light) hover:to-(--alt-gold) text-(--alt-navy-deeper) font-heading font-bold text-xl uppercase tracking-wider rounded-full transition-all duration-300 shadow-lg hover:scale-105">
                    {{ __('Apply to Volunteer') }}
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
            <div class="absolute inset-0 bg-(--alt-navy-dark)/85"></div>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto px-4">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-(--alt-gold) bg-(--alt-gold)/10 border border-(--alt-gold)/30 rounded-full mb-4">
                    {{ __('FAQ') }}
                </span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">{{ __('Questions & Answers') }}</h2>
                <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-(--alt-gold) to-transparent mx-auto mb-6"></div>
                <p class="text-(--alt-beige-muted) text-lg">{{ __('Everything you need to know about Europe Revival 2026') }}</p>
            </div>

            {{-- FAQ Accordion --}}
            <div class="space-y-4">
                @foreach ($this->faqs as $index => $faq)
                    <x-home.faq-item :faq="$faq" :index="$index + 1" wire:key="faq-{{ $faq->id }}">
                        @if ($faq->category === 'volunteer')
                            <a href="{{ route('volunteer') }}" class="inline-flex items-center gap-2 text-(--alt-gold) mt-4 hover:underline">
                                {{ __('Apply Now') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endif
                        @if ($faq->question === 'Where is the conference held?')
                            <div class="mt-4 rounded-lg overflow-hidden border border-(--alt-beige)/10">
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
                <p class="text-(--alt-beige-muted) mb-4">{{ __('Still have questions?') }}</p>
                <a href="mailto:info@iriseuroperevival.com"
                    class="text-(--alt-gold) hover:text-(--alt-gold-light) font-heading font-medium transition-colors">
                    {{ __('Contact us at info@iriseuroperevival.com') }}
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
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/stadium-background.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-(--alt-navy-deeper)/50"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            {{-- Script accent --}}
            <p class="font-script text-(--alt-gold-light) text-3xl md:text-6xl mb-4">{{ __('the nations gather') }}</p>

            <h2 class="font-heading text-4xl md:text-6xl font-bold uppercase tracking-wide text-(--alt-beige) mb-4">
                {{ __('Encounter Jesus') }}<br>
                <span class="text-transparent bg-clip-text bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light)">{{ __('Catch on Fire') }}</span>
            </h2>
            <p class="text-xl md:text-2xl text-(--alt-beige-muted) mb-4 max-w-2xl mx-auto font-heading font-medium">
                {!! nl2br(e(__('Revival awaits. Be a part of what God is doing in Europe!'))) !!}
            </p>
            <p class="text-lg text-(--alt-beige-muted)/60 mb-10 max-w-2xl mx-auto">
                {{ __("Don't miss out! Join thousands of believers from across Europe for three days that could change your life forever.") }}
            </p>

            <a href="{{ route('register') }}"
                class="group inline-flex items-center gap-3 px-10 py-5 bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) hover:from-(--alt-gold-light) hover:to-(--alt-gold) text-(--alt-navy-deeper) font-heading font-bold text-xl uppercase tracking-wider rounded-full transition-all duration-300 shadow-lg hover:scale-105">
                {{ __('Register Now') }}
                <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>

            <p class="mt-8 text-(--alt-beige-muted)/60 font-heading uppercase tracking-wider">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ __('October 23-25, 2026 • Budapest, BOK Hall, Hungary') }}
            </p>
        </div>
    </section>

    {{-- ============================================
    SPONSORS SECTION
============================================= --}}
    <section class="py-24 bg-(--alt-navy-dark)">
        <div class="max-w-7xl mx-auto px-4">
            @if ($this->mainSponsor)
                <div class="text-center mb-16">
                    <span class="text-(--alt-beige-muted)/60 text-sm font-heading uppercase tracking-[0.2em] mb-4 block">{{ __('Presented by') }}</span>
                    <x-home.sponsor-logo :sponsor="$this->mainSponsor" size="main" />
                </div>
            @endif

            @if ($this->partnerSponsors->isNotEmpty())
                <div class="text-center mb-8">
                    <span class="text-(--alt-beige-muted)/60 text-sm font-heading uppercase tracking-[0.2em]">{{ __('Partner Organizations') }}</span>
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
