@props([
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $eventId = config('services.cooltix.event_id');

    $variants = [
        'primary' => 'bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) hover:from-(--alt-gold-light) hover:to-(--alt-gold) text-(--alt-navy-deeper) shadow-lg hover:scale-105',
        'navy' => 'bg-(--alt-navy) hover:bg-(--alt-navy-dark) text-(--alt-beige) shadow-lg',
        'outline' => 'bg-transparent border-2 border-(--alt-gold)/40 hover:border-(--alt-gold)/70 hover:bg-(--alt-gold)/10 text-(--alt-beige)',
    ];

    $sizes = [
        'sm' => 'px-6 py-2.5 text-base',
        'md' => 'px-8 py-4 text-lg uppercase tracking-wider',
    ];
@endphp

@if ($eventId)
    <button type="button"
        data-cooltix-event-products="{{ $eventId }}"
        {{ $attributes->class([
            'group inline-flex items-center justify-center gap-2 font-heading font-bold rounded-full transition-all duration-300 cursor-pointer',
            $variants[$variant] ?? $variants['primary'],
            $sizes[$size] ?? $sizes['md'],
        ]) }}>
        {{ $slot->isEmpty() ? __('View Tickets') : $slot }}
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 012 2v3a2 2 0 000 4v3a2 2 0 01-2 2H5a2 2 0 01-2-2v-3a2 2 0 000-4V7a2 2 0 012-2z" />
        </svg>
    </button>
@endif
