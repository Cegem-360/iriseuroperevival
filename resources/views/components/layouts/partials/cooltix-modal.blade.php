@php
    $eventId = config('services.cooltix.event_id');

    $widgetUrl = $eventId
        ? 'https://cooltix.com/widget/event-products/' . $eventId . '?' . http_build_query([
            'referrerUrl' => url()->current(),
            'locale' => app()->getLocale(),
            'theme' => 'dark',
        ])
        : null;
@endphp

@if ($eventId)
    <div x-data="{ open: false }"
         x-show="open"
         x-on:open-cooltix-modal.window="open = true"
         x-on:keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-100 flex items-center justify-center p-4"
         style="display: none;">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="open = false"></div>
        <div class="relative z-10 w-full max-w-2xl h-[85vh] bg-(--alt-navy) border border-(--alt-gold)/20 rounded-2xl overflow-hidden shadow-2xl flex flex-col"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between gap-4 px-6 py-4 border-b border-(--alt-gold)/20">
                <h2 class="font-heading text-lg font-bold text-(--alt-beige)">{{ __('Tickets') }}</h2>
                <button type="button" @click="open = false" class="w-10 h-10 shrink-0 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors cursor-pointer">
                    <svg class="w-6 h-6 text-(--alt-beige)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 bg-(--alt-navy-dark)">
                <template x-if="open">
                    <iframe src="{{ $widgetUrl }}"
                            title="{{ __('Tickets') }}"
                            class="w-full h-full"
                            frameborder="0"
                            allow="payment"></iframe>
                </template>
            </div>
        </div>
    </div>
@endif
