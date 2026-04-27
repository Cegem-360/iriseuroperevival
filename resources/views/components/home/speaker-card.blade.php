@props(['speaker', 'showArrow' => true, 'workshopTopic' => null])

<div class="relative group/card block">
    <a href="{{ route('speaker.show', $speaker->slug) }}" class="speaker-card group block">
        <img src="{{ $speaker->photo_path ? Vite::asset('resources/' . $speaker->photo_path) : Vite::asset('resources/images/speakers/placeholder.webp') }}"
            alt="{{ $speaker->name }}">
        <div class="speaker-card-content">
            @if ($workshopTopic)
                <span class="badge-amber mb-2">{{ $workshopTopic }}</span>
            @elseif ($speaker->t('title'))
                <span class="badge-{{ $speaker->is_featured ? 'amber' : 'info' }} mb-2">{{ $speaker->t('title') }}</span>
            @endif
            <h3 class="text-{{ $speaker->is_featured ? 'xl' : 'lg' }} font-bold text-white">{{ $speaker->name }}</h3>
            @if ($speaker->t('organization'))
                <p class="text-white/60 text-sm">{{ $speaker->t('organization') }}</p>
            @endif
        </div>
        @if ($showArrow)
            <div
                class="absolute top-4 right-4 w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 z-20">
                <svg class="w-5 h-5 text-navy-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </div>
        @endif
    </a>

    {{-- Bio Overlay --}}
    @if ($speaker->t('bio'))
        <div
            class="absolute inset-0 z-30 rounded-2xl overflow-hidden pointer-events-none group-hover/card:pointer-events-auto">
            {{-- Blur layer - always blurred, opacity transitions --}}
            <div
                class="absolute inset-0 backdrop-blur-sm opacity-0 group-hover/card:opacity-100 transition-opacity duration-400 ease-in-out">
            </div>
            {{-- Gradient layer --}}
            <div
                class="absolute inset-0 bg-gradient-to-b from-navy-950/95 via-navy-900/75 to-ocean-700/85 opacity-0 group-hover/card:opacity-100 transition-opacity duration-400 ease-in-out">
            </div>
            {{-- Content layer --}}
            <div
                class="absolute inset-0 p-5 flex flex-col opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">
                <h4 class="text-white font-bold">{{ $speaker->name }}</h4>
                @if ($speaker->t('title'))
                    <span class="text-sky-400 text-xs font-medium mb-3">{{ $speaker->t('title') }}</span>
                @endif
                <div class="relative flex-1 min-h-0">
                    <p class="text-white/80 text-sm leading-relaxed overflow-y-auto h-full pb-12"
                        style="mask-image: linear-gradient(to bottom, black 70%, transparent 95%);">{{ $speaker->t('bio') }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
