<div>
    {{-- Breadcrumb --}}
    <section class="bg-navy-950 pt-24 pb-4">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-white/50 hover:text-white transition-colors">{{ __('Home') }}</a>
                <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('speakers') }}" class="text-white/50 hover:text-white transition-colors">{{ __('Speakers') }}</a>
                <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-primary-400">{{ $speaker->name }}</span>
            </nav>
        </div>
    </section>

    {{-- Speaker Hero --}}
    <section class="py-16 bg-navy-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-[20rem_1fr] gap-12 items-start">
                {{-- Photo --}}
                <div class="relative max-w-xs">
                    <div class="aspect-3/4 rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ $speaker->photo_path ? Vite::asset('resources/' . $speaker->photo_path) : Vite::asset('resources/images/speakers/placeholder.webp') }}"
                             alt="{{ $speaker->name }}"
                             class="w-full h-full object-cover">
                    </div>
                    {{-- Glow Effect --}}
                    <div class="absolute -inset-4 bg-primary-500/10 blur-3xl -z-10 rounded-full"></div>
                </div>

                {{-- Info --}}
                <div class="lg:py-8">
                    @if($speaker->t('title'))
                        <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-primary-400 bg-primary-500/10 border border-primary-500/30 rounded-full mb-4">
                            {{ $speaker->t('title') }}
                        </span>
                    @endif

                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $speaker->name }}</h1>

                    @if($speaker->t('organization') || $speaker->country)
                        <div class="flex flex-wrap items-center gap-4 mb-6">
                            @if($speaker->t('organization'))
                                <div class="flex items-center gap-2 text-white/60">
                                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    <span>{{ $speaker->t('organization') }}</span>
                                </div>
                            @endif
                            @if($speaker->country)
                                <div class="flex items-center gap-2 text-white/60">
                                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $speaker->country }}</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Bio --}}
                    @if($speaker->t('bio'))
                        <div class="text-white/70 leading-relaxed whitespace-pre-line mb-8">{{ $speaker->t('bio') }}</div>
                    @endif

                    {{-- Social Links --}}
                    @if($speaker->social_links && count($speaker->social_links) > 0)
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-white/50 uppercase tracking-wider mb-4">{{ __('Connect') }}</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($speaker->social_links as $platform => $url)
                                    @if($url)
                                        <a href="{{ str_starts_with($url, 'http') ? $url : 'https://' . $url }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-navy-800/50 hover:bg-navy-800 border border-navy-700 hover:border-primary-500/50 rounded-lg text-white/70 hover:text-white transition-all">
                                            @switch(strtolower($platform))
                                                @case('twitter')
                                                @case('x')
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                    </svg>
                                                    @break
                                                @case('facebook')
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                    </svg>
                                                    @break
                                                @case('instagram')
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                                    </svg>
                                                    @break
                                                @case('youtube')
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                    </svg>
                                                    @break
                                                @case('website')
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                                    </svg>
                                                    @break
                                                @default
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                    </svg>
                                            @endswitch
                                            <span class="capitalize">{{ $platform }}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- CTA --}}
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="btn-primary">
                            {{ __('Register for Conference') }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('speakers') }}" class="btn-secondary">
                            {{ __('View All Speakers') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Other Speakers --}}
    @if($otherSpeakers->isNotEmpty())
        <section class="py-20 bg-navy-900">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-white mb-4">{{ __('Other Speakers') }}</h2>
                    <p class="text-white/50">{{ __('Discover more anointed ministers at Europe Revival 2026') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($otherSpeakers as $otherSpeaker)
                        <a href="{{ route('speaker.show', $otherSpeaker->slug) }}"
                           class="group relative overflow-hidden rounded-2xl bg-navy-800/50 border border-navy-700 hover:border-primary-500/50 transition-all duration-300"
                           wire:key="other-{{ $otherSpeaker->id }}">
                            <div class="aspect-3/4 overflow-hidden">
                                <img src="{{ $otherSpeaker->photo_path ? Vite::asset('resources/' . $otherSpeaker->photo_path) : Vite::asset('resources/images/speakers/placeholder.webp') }}"
                                     alt="{{ $otherSpeaker->name }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-linear-to-t from-navy-900 via-navy-900/20 to-transparent"></div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                @if($otherSpeaker->title)
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-primary-400 bg-primary-500/20 border border-primary-500/30 rounded-full mb-3">
                                        {{ $otherSpeaker->title }}
                                    </span>
                                @endif
                                <h3 class="text-lg font-bold text-white mb-1">{{ $otherSpeaker->name }}</h3>
                                @if($otherSpeaker->organization)
                                    <p class="text-white/60 text-sm">{{ $otherSpeaker->organization }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
