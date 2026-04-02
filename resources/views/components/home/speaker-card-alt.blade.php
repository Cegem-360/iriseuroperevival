@props(['speaker', 'showArrow' => true, 'workshopTopic' => null, 'titleOverride' => null])

@php
    // Map speaker slugs to designer portrait files
    $altPortraits = [
        'heidi-baker' => 'images/alt-style/speakers/speaker-heidi.webp',
        'mel-tari' => 'images/alt-style/speakers/speaker-mel.webp',
        'david-gava' => 'images/alt-style/speakers/speaker-gava.webp',
    ];

    // Map workshop leader slugs to designer portrait files
    $altWorkshopPortraits = [
        'baoyan-lam' => 'images/alt-style/workshop-leaders/baoyan.webp',
        'mary-pat-gokee' => 'images/alt-style/workshop-leaders/gokee.webp',
        'katey-maddux' => 'images/alt-style/workshop-leaders/katey.webp',
        'tineke-bouwman' => 'images/alt-style/workshop-leaders/tine.webp',
    ];

    $altPhoto = $altPortraits[$speaker->slug] ?? null;
    $altWorkshopPhoto = $altWorkshopPortraits[$speaker->slug] ?? null;
    $hasDesignerPhoto = $altPhoto || $altWorkshopPhoto;
    $photoSrc = $hasDesignerPhoto
        ? Vite::asset('resources/' . ($altPhoto ?? $altWorkshopPhoto))
        : ($speaker->photo_path ? Vite::asset('resources/' . $speaker->photo_path) : Vite::asset('resources/images/speakers/placeholder.webp'));
@endphp

<div class="relative group/card block" x-data="{ bioOpen: false }">
    <a href="{{ route('speaker.show', $speaker->slug) }}"
        class="{{ $altWorkshopPhoto ? 'relative overflow-hidden rounded-2xl bg-navy-800 cursor-pointer block' : 'speaker-card group block' }}{{ $altPhoto ? ' no-gradient' : '' }}"
        style="border: 1px solid rgba(200, 160, 80, 0.15);{{ $altWorkshopPhoto ? ' aspect-ratio: 5/6;' : '' }}{{ $altPhoto ? ' aspect-ratio: 1/1;' : '' }}">
        <img src="{{ $photoSrc }}" alt="{{ $speaker->name }}"
            class="absolute inset-0 w-full h-full object-cover {{ $altPhoto ? 'sepia-[.2]' : '' }}"
            style="{{ $altWorkshopPhoto ? 'transition: transform 700ms;' : '' }}">
        @if ($altWorkshopPhoto)
            {{-- Designer workshop images have topic text baked in — no overlay needed --}}
        @else
            <div class="speaker-card-content {{ $altPhoto ? 'text-right items-end max-w-[85%] ml-auto' : '' }}">
                @if ($workshopTopic)
                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-[var(--alt-gold)]/20 text-[var(--alt-gold)] border border-[var(--alt-gold)]/30 font-heading uppercase tracking-wider mb-2">{{ $workshopTopic }}</span>
                @endif
                <h3 class="text-{{ $speaker->is_featured ? 'xl' : 'lg' }} font-heading font-bold uppercase tracking-wide text-[var(--alt-beige)]">{{ $speaker->name }}</h3>
                @if ($titleOverride ?? $speaker->title)
                    <p class="text-[var(--alt-beige-muted)] text-sm">{{ $titleOverride ?? $speaker->title }}</p>
                @endif
                @if ($speaker->organization)
                    <p class="text-[var(--alt-beige-muted)] text-sm">{!! strip_tags($speaker->organization, '<br>') !!}</p>
                @endif
            </div>
        @endif
        @if ($showArrow)
            <div class="absolute top-4 right-4 w-10 h-10 bg-[var(--alt-gold)] rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 z-20 hidden lg:flex">
                <svg class="w-5 h-5 text-[var(--alt-navy-deeper)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </div>
        @endif
    </a>

    {{-- Mobile Bio Button --}}
    @if ($speaker->bio)
        <button @click.prevent="bioOpen = true"
            class="lg:hidden absolute top-3 right-3 z-20 w-9 h-9 bg-[var(--alt-navy-deeper)]/70 backdrop-blur-sm rounded-full flex items-center justify-center border border-[var(--alt-beige)]/20">
            <svg class="w-4 h-4 text-[var(--alt-beige)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    @endif

    {{-- Desktop Bio Overlay (hover) --}}
    @if ($speaker->bio)
        <div class="hidden lg:block absolute inset-0 z-30 rounded-2xl overflow-hidden pointer-events-none group-hover/card:pointer-events-auto">
            <div class="absolute inset-0 backdrop-blur-sm opacity-0 group-hover/card:opacity-100 transition-opacity duration-400 ease-in-out"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-[var(--alt-navy-deeper)]/95 via-[var(--alt-navy)]/90 to-[var(--alt-navy-dark)]/95 opacity-0 group-hover/card:opacity-100 transition-opacity duration-400 ease-in-out"></div>
            <div class="absolute inset-0 p-5 flex flex-col opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">
                <h4 class="font-heading font-bold uppercase tracking-wide text-[var(--alt-beige)]">{{ $speaker->name }}</h4>
                @if ($titleOverride ?? $speaker->title)
                    <span class="text-[var(--alt-gold)] text-xs font-heading font-medium uppercase tracking-wider mb-3">{{ $titleOverride ?? $speaker->title }}</span>
                @endif
                <div class="relative flex-1 min-h-0">
                    <p class="text-[var(--alt-beige-muted)] text-sm leading-relaxed overflow-y-auto h-full pb-12"
                        style="mask-image: linear-gradient(to bottom, black 70%, transparent 95%);">{{ $speaker->bio }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Mobile Bio Modal --}}
    @if ($speaker->bio)
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
                <div class="relative w-full max-w-sm max-h-[80vh] rounded-2xl overflow-hidden bg-[var(--alt-navy-dark)] border border-[var(--alt-beige)]/15 shadow-2xl flex flex-col"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95">
                    {{-- Speaker Photo --}}
                    <div class="relative h-48 shrink-0">
                        <img src="{{ $photoSrc }}" alt="{{ $speaker->name }}" class="w-full h-full object-cover {{ $altPhoto ? 'sepia-[.2]' : '' }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-[var(--alt-navy-dark)] to-transparent"></div>
                        <button @click="bioOpen = false" class="absolute top-3 right-3 w-8 h-8 bg-black/40 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="absolute bottom-3 left-4 right-4">
                            <h4 class="font-heading font-bold uppercase tracking-wide text-[var(--alt-beige)] text-lg">{{ $speaker->name }}</h4>
                            @if ($titleOverride ?? $speaker->title)
                                <span class="text-[var(--alt-gold)] text-xs font-heading font-medium uppercase tracking-wider">{{ $titleOverride ?? $speaker->title }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- Bio --}}
                    <div class="p-5 overflow-y-auto">
                        <p class="text-[var(--alt-beige-muted)] text-sm leading-relaxed">{{ $speaker->bio }}</p>
                    </div>
                </div>
            </div>
        </template>
    @endif
</div>
