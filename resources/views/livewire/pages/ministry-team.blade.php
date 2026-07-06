<div>
    {{-- ============================================
    HERO SECTION
    ============================================= --}}
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-br from-navy-950 via-navy-800 to-navy-950"></div>
        <div class="absolute inset-0">
            <img src="{{ Vite::asset('resources/images/alt-style/backgrounds/stadium-background-3.webp') }}" alt="" class="w-full h-full object-cover opacity-25">
        </div>
        <div class="absolute inset-0 bg-linear-to-t from-navy-950 via-transparent to-navy-950/50"></div>

        {{-- Decorative blurs --}}
        <div class="absolute top-20 left-10 w-72 h-72 bg-sky-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-36 pb-20">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sky-400/10 border border-sky-400/20 mb-6">
                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <span class="text-sky-400 font-medium">{{ __('Serve with us') }}</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                {!! __('Join the<br><span class="text-gradient">Ministry Team</span>') !!}
            </h1>

            <p class="text-xl text-white/70 mb-2 max-w-2xl mx-auto">
                {{ __('Be part of how God touches lives at Europe Revival 2026.') }}
            </p>
            <p class="text-lg text-white/60 mb-8 max-w-2xl mx-auto">
                {{ __('Apply to serve in healing rooms, prophetic ministry, evangelism, and many other areas.') }}
            </p>

            {{-- Stats --}}
            <div class="flex flex-wrap justify-center gap-8 mt-12">
                <div class="text-center">
                    <div class="text-3xl font-bold text-sky-400">{{ __('1-day') }}</div>
                    <div class="text-white/70 text-base">{{ __('training') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-sky-400">5+</div>
                    <div class="text-white/70 text-base">{{ __('ministry areas') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-sky-400">{{ __('Free') }}</div>
                    <div class="text-white/70 text-base">{{ __('conference pass') }}</div>
                </div>
            </div>

            {{-- Scroll indicator --}}
            <a href="#about" class="inline-flex flex-col items-center mt-12 text-white/60 hover:text-sky-400 transition-colors">
                <span class="text-base mb-2">{{ __('Learn more') }}</span>
                <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </section>

    {{-- ============================================
    ABOUT MINISTRY TEAM SECTION
    ============================================= --}}
    <section id="about" class="py-20 bg-navy-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Content --}}
                <div>
                    <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">{{ __('Why Join?') }}</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-6">
                        {{ __('Serve God\'s Kingdom') }}
                    </h2>
                    <p class="text-white/70 text-lg mb-8">
                        {{ __('As a member of the Ministry Team, you\'ll have a unique opportunity to actively participate in what God is doing throughout the conference.') }}
                    </p>

                    {{-- Benefits --}}
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">{{ __('Gain hands-on ministry experience') }}</h4>
                                <p class="text-white/40 text-sm">{{ __('Training Day — October 22 (Thursday), from 9:00 AM to 5:00 PM') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">{{ __('Be part of an international community') }}</h4>
                                <p class="text-white/40 text-sm">{{ __('Serve alongside brothers from all across Europe.') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">{{ __('Grow in your spiritual gifts') }}</h4>
                                <p class="text-white/40 text-sm">{{ __('Free admission for approved applicants') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Client-supplied image (replaces the temporary promo-video placeholder, per Dóri 2026-05-20). --}}
                <div class="relative">
                    <div class="absolute -inset-4 bg-linear-to-r from-sky-400/20 to-primary-500/20 rounded-2xl blur-2xl"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-video bg-navy-700">
                        <img src="{{ Vite::asset('resources/images/alt-style/ministry-team-promo.webp') }}"
                            alt=""
                            class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Promo-video player kept around in case the client meant "swap the cover, keep the video" — uncomment this block and delete the static image above to restore.
                <div class="relative" x-data="{ playing: false }">
                    <div class="absolute -inset-4 bg-linear-to-r from-sky-400/20 to-primary-500/20 rounded-2xl blur-2xl"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-video bg-navy-700">
                        <template x-if="!playing">
                            <div class="absolute inset-0 cursor-pointer" @click="playing = true">
                                <img src="{{ Vite::asset('resources/images/alt-style/ministry-team-promo.webp') }}"
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
                        <template x-if="playing">
                            <iframe
                                src="https://www.youtube.com/embed/{{ app()->getLocale() === 'hu' ? 'na1zYGt9rjg' : 'VBrCtvqwPcc' }}?autoplay=1&rel=0"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="autoplay; encrypted-media"
                                allowfullscreen>
                            </iframe>
                        </template>
                    </div>
                </div>
                --}}
            </div>
        </div>
    </section>

    {{-- ============================================
    SERVICE AREAS SECTION
    ============================================= --}}
    <section id="service-areas" class="py-20 bg-linear-to-b from-navy-950 to-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">{{ __('Ministry Areas') }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                    {{ __('Where would you like to serve?') }}
                </h2>
                <p class="text-white/50 max-w-2xl mx-auto">
                    {{ __('Select the areas where you\'d be happy to serve. You can choose multiple options.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Evangelism Team Leader --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-sky-400 to-ocean-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ __('Evangelism Team Leader') }}</h3>
                    <p class="text-white/50 text-sm mb-4">{{ __('Lead and coordinate small outreach teams during street evangelism.') }}</p>
                </div>

                {{-- Healing Rooms (formerly "Gyógyító szobák" → "Ima a gyógyulásért", 30 perc) --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-sky-400 to-ocean-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ __('Healing Rooms') }}</h3>
                    <p class="text-white/50 text-sm mb-4">{{ __('Pray for the sick and provide personal ministry for those seeking healing. 30-minute one-on-one sessions.') }}</p>
                </div>

                {{-- Prophetic Rooms --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-ocean-500 to-sky-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ __('Prophetic Rooms') }}</h3>
                    <p class="text-white/50 text-sm mb-4">{{ __('Encourage others through prophetic ministry, sharing God\'s heart with people.') }}</p>
                </div>

                {{-- Prayer Team --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-ocean-500 to-sky-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ __('Prayer Team') }}</h3>
                    <p class="text-white/50 text-sm mb-4">{{ __('Intercede for the conference, speakers, and participants behind the scenes and during altar calls.') }}</p>
                </div>

                {{-- Hospitality Team (formerly "Fogadó szolgálat" → "Vendégfogadás") --}}
                <div class="group bg-navy-700/50 backdrop-blur-sm rounded-xl p-6 border border-navy-600 hover:border-sky-400/50 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-sky-400 to-ocean-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ __('Hospitality Team') }}</h3>
                    <p class="text-white/50 text-sm mb-4">{{ __('Greet guests, assist with registration, provide information, and support on-site.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    TRAINING DAY SECTION
    ============================================= --}}
    <section class="py-20 bg-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-linear-to-r from-sky-400/10 to-primary-500/10 rounded-2xl p-8 md:p-12 border border-sky-400/20">
                <div class="grid md:grid-cols-2 gap-8 items-start">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-400/20 text-sky-400 text-sm font-medium mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Mandatory') }}
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
                            {{ __('Training Day') }}
                        </h3>
                        <p class="text-white/70 mb-3">
                            {{ __('The training day is mandatory for all Ministry Team members. Here you will receive preparation and ministry guidelines.') }}
                        </p>
                        <p class="text-white/50 text-sm mb-6">
                            {{ __('Please note that the program is subject to change. Detailed information will be sent via email.') }}
                        </p>
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center gap-3 text-white/70">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span><strong>{{ __('October 22, 2026 (Thursday)') }}</strong></span>
                            </div>
                            <div class="flex items-center gap-3 text-white/70">
                                <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>09:00 – 17:00</span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sky-400 text-sm font-semibold uppercase tracking-wider mb-3">{{ __('Speakers') }}</div>
                            <ul class="space-y-2 text-white/70">
                                <li>{!! __('<strong>David Gava</strong> — deliverance and healing and move of the Holy Spirit') !!}</li>
                                <li>{!! __('<strong>Jan & Alan Kilpatrick</strong> — prayer ministry') !!}</li>
                                <li>{!! __('<strong>Dr. Kate Hartmann</strong> — cross-cultural ministry') !!}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-navy-900/50 rounded-xl p-6">
                        <h4 class="text-white font-semibold mb-4">{{ __('Program') }}</h4>
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-28 shrink-0 whitespace-nowrap">10:00 – 10:30</div>
                                <div class="text-white/70">{{ __('Ice breakers') }}</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-28 shrink-0 whitespace-nowrap">10:30 – 11:30</div>
                                <div class="text-white/70">{{ __('Ministering and working together cross-culturally — Dr. Kate Hartmann') }}</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-28 shrink-0 whitespace-nowrap">11:45 – 12:45</div>
                                <div class="text-white/70">{{ __('Prayer ministry in events — Jan & Alan Kilpatrick') }}</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-28 shrink-0 whitespace-nowrap">12:45 – 14:00</div>
                                <div class="text-white/70">{{ __('Lunch break') }}</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-28 shrink-0 whitespace-nowrap">14:00 – 15:00</div>
                                <div class="text-white/70">{{ __('Worship by Iris Europe Worship') }}</div>
                            </div>
                            <div class="flex gap-4">
                                <div class="text-sky-400 font-mono text-sm w-28 shrink-0 whitespace-nowrap">15:00 – 17:00</div>
                                <div class="text-white/70">{{ __('Deliverance and healing and move of the Holy Spirit — David Gava') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    FAQ SECTION
    ============================================= --}}
    <section id="faq" class="py-20 bg-navy-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">{{ __('FAQ') }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                    {{ __('Frequently Asked Questions') }}
                </h2>
                <p class="text-white/50">
                    {{ __('Answers to frequently asked questions for the Ministry Team.') }}
                </p>
            </div>

            @if ($this->faqs->isNotEmpty())
                <div class="space-y-4" x-data="{ open: null }">
                    @foreach ($this->faqs as $faq)
                        <div class="bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden" wire:key="faq-{{ $faq->id }}">
                            <button @click="open = open === {{ $faq->id }} ? null : {{ $faq->id }}" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="text-white font-semibold">{{ $faq->t('question') }}</span>
                                </div>
                                <svg class="w-5 h-5 text-white/40 transition-transform" :class="{ 'rotate-180': open === {{ $faq->id }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open === {{ $faq->id }}" x-cloak x-collapse class="px-6 pb-4">
                                <div class="pl-13 text-white/50 space-y-3 [&_strong]:text-sky-400 [&_strong]:font-medium [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-1 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:space-y-1 [&_a]:text-sky-400 [&_a]:underline-offset-2 hover:[&_a]:underline">
                                    {!! $faq->t('answer') !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ============================================
    APPLICATION FORM SECTION
    ============================================= --}}
    <section id="apply" class="py-20 bg-linear-to-b from-navy-950 to-navy-800">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-sky-400 font-semibold text-sm uppercase tracking-wider">{{ __('Apply now') }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                    {{ __('Ministry Team application') }}
                </h2>
                <p class="text-white/50">
                    {!! __('Fill out the form below to apply. Application deadline: <strong>August 31, 2026</strong>.') !!}
                </p>
            </div>

           {{--  @if($submitted)
                <div class="bg-navy-700/50 backdrop-blur-sm rounded-2xl p-8 border border-navy-600 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Köszönjük a jelentkezésedet!</h3>
                    <p class="text-white/50 max-w-md mx-auto mb-6">
                        A jelentkezésedet megkaptuk. Hamarosan felvesszük a kapcsolatot a lelkipásztoroddal, majd e-mailben értesítünk a döntésről.
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-sky-400 text-navy-800 font-semibold rounded-full hover:bg-sky-300 transition-colors">
                        Vissza a főoldalra
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            @else --}}
                <div class="dark fi-navy-form bg-navy-700/50 backdrop-blur-sm rounded-2xl p-8 border border-navy-600">
                    <form wire:submit="submit" class="space-y-8">
                        {{ $this->form }}
                    </form>
                </div>
            {{-- @endif --}}
        </div>
    </section>

    {{-- ============================================
    FINAL CTA SECTION
    ============================================= --}}
    <section class="py-20 bg-navy-950 relative overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-r from-sky-400/5 to-primary-500/5"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-sky-400/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                {{ __('Be part of the miracle!') }}
            </h2>
            <p class="text-xl text-white/70 mb-8">
                {{ __('God\'s plan includes you at this conference as well. Don\'t miss out — apply to the Ministry Team today!') }}
            </p>
            <div class="flex justify-center">
                <a href="#apply" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-linear-to-r from-primary-400 to-primary-600 hover:from-primary-500 hover:to-primary-700 text-navy-900 font-semibold transition-all duration-300 shadow-lg shadow-primary-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    {{ __('Register now') }}
                </a>
            </div>
        </div>
    </section>
</div>
