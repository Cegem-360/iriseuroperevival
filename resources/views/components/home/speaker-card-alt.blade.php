@props(['speaker', 'showArrow' => true, 'workshopTopic' => null, 'titleOverride' => null, 'portraitPath' => null, 'workshopDescription' => null])

@php
    // Map speaker slugs to designer portrait files
    $altPortraits = [
        'heidi-baker' => 'images/alt-style/speakers/speaker-heidi.webp',
        'mel-tari' => 'images/alt-style/speakers/speaker-mel.webp',
        'ben-fitzgerald' => 'images/alt-style/speakers/speaker-ben.webp',
        'david-gava' => 'images/alt-style/speakers/speaker-gava.webp',
    ];

    $resolvedPortrait = $portraitPath ?? ($altPortraits[$speaker->slug] ?? null);
    $hasDesignerPhoto = (bool) $resolvedPortrait;
    $photoSrc = $resolvedPortrait
        ? Vite::asset('resources/' . $resolvedPortrait)
        : ($speaker->photo_url ?? Vite::asset('resources/images/speakers/placeholder.webp'));
    $overlayHeading = $workshopTopic ?? $speaker->name;
    $overlaySubheading = $workshopTopic ? null : ($titleOverride ?? $speaker->t('title'));
    $overlayBody = $workshopDescription ?? $speaker->t('bio');
@endphp

<div class="relative group/card block" x-data="{ bioOpen: false }">
    <a href="{{ route('speaker.show', $speaker->slug) }}"
        class="speaker-card group block{{ $hasDesignerPhoto ? ' no-gradient' : '' }}"
        style="border: 1px solid rgba(200, 160, 80, 0.15); aspect-ratio: 5/6;">
        <img src="{{ $photoSrc }}" alt="{{ $speaker->name }}"
            class="absolute inset-0 w-full h-full object-cover {{ $hasDesignerPhoto ? 'sepia-[.2]' : '' }}">
        <div class="speaker-card-content {{ $hasDesignerPhoto ? 'text-right items-end max-w-[95%] ml-auto' : '' }}">
            @if ($workshopTopic)
                <h3 class="text-lg font-heading font-bold uppercase tracking-wide text-(--alt-beige)">{{ $workshopTopic }}</h3>
            @else
                <h3 class="text-{{ $speaker->is_featured ? 'xl' : 'lg' }} font-heading font-bold uppercase tracking-wide text-(--alt-beige)">{{ $speaker->name }}</h3>
                @if ($titleOverride ?? $speaker->t('title'))
                    <p class="text-(--alt-beige-muted) text-sm">{{ $titleOverride ?? $speaker->t('title') }}</p>
                @endif
                @if ($speaker->t('organization'))
                    <p class="text-(--alt-beige-muted) text-sm">{!! strip_tags($speaker->t('organization'), '<br>') !!}</p>
                @endif
            @endif
        </div>
        @if ($showArrow)
            <div class="absolute top-4 right-4 w-10 h-10 bg-(--alt-gold) rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 z-20 hidden lg:flex">
                <svg class="w-5 h-5 text-(--alt-navy-deeper)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </div>
        @endif
    </a>

    {{-- Mobile Bio Button --}}
    @if ($overlayBody)
        <button @click.prevent="bioOpen = true"
            class="lg:hidden absolute top-6 right-3 z-20 px-4 py-2 bg-sky-700 rounded-full flex items-center justify-center shadow-md">
            <span class="text-white text-sm font-heading font-bold uppercase tracking-wider">{{ $workshopDescription ? 'Info' : 'Bio' }}</span>
        </button>
    @endif

    {{-- Desktop Bio Overlay (hover) --}}
    @if ($overlayBody)
        <div class="hidden lg:block absolute inset-0 z-30 rounded-2xl overflow-hidden pointer-events-none group-hover/card:pointer-events-auto">
            <div class="absolute inset-0 backdrop-blur-sm opacity-0 group-hover/card:opacity-100 transition-opacity duration-400 ease-in-out"></div>
            <div class="absolute inset-0 bg-linear-to-b from-(--alt-navy-deeper)/95 via-(--alt-navy)/90 to-(--alt-navy-dark)/95 opacity-0 group-hover/card:opacity-100 transition-opacity duration-400 ease-in-out"></div>
            <div class="absolute inset-0 p-5 flex flex-col opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">
                <h4 class="font-heading font-bold uppercase tracking-wide text-(--alt-beige)">{{ $overlayHeading }}</h4>
                @if ($overlaySubheading)
                    <span class="text-(--alt-gold) text-xs font-heading font-medium uppercase tracking-wider mb-3">{{ $overlaySubheading }}</span>
                @endif
                <div class="relative flex-1 min-h-0">
                    <p class="text-(--alt-beige-muted) text-sm leading-relaxed overflow-y-auto h-full pb-12 whitespace-pre-line"
                        style="mask-image: linear-gradient(to bottom, black 70%, transparent 95%);">{{ $overlayBody }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Mobile Bio Modal --}}
    @if ($overlayBody)
        <template x-teleport="body">
            <div x-show="bioOpen" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center p-4"
                @click.self="bioOpen = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                {{-- Backdrop --}}
                <div class="absolute inset-0 bg-black/70" @click="bioOpen = false"></div>
                {{-- Modal Content --}}
                <div class="relative w-full max-w-sm max-h-[80vh] rounded-2xl overflow-hidden bg-(--alt-navy-dark) border border-(--alt-beige)/15 shadow-2xl flex flex-col"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95">
                    {{-- Speaker Photo --}}
                    <div class="relative h-48 shrink-0">
                        <img src="{{ $photoSrc }}" alt="{{ $speaker->name }}" class="w-full h-full object-cover {{ $hasDesignerPhoto ? 'sepia-[.2]' : '' }}">
                        <div class="absolute inset-0 bg-linear-to-t from-(--alt-navy-dark) to-transparent"></div>
                        <button @click="bioOpen = false" class="absolute top-3 right-3 w-8 h-8 bg-black/40 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="absolute bottom-3 left-4 right-4">
                            <h4 class="font-heading font-bold uppercase tracking-wide text-(--alt-beige) text-lg">{{ $overlayHeading }}</h4>
                            @if ($overlaySubheading)
                                <span class="text-(--alt-gold) text-xs font-heading font-medium uppercase tracking-wider">{{ $overlaySubheading }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- Body --}}
                    <div class="p-5 overflow-y-auto">
                        <p class="text-(--alt-beige-muted) text-sm leading-relaxed whitespace-pre-line">{{ $overlayBody }}</p>
                    </div>
                </div>
            </div>
        </template>
    @endif
</div>
