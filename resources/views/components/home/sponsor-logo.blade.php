@props([
    'sponsor',
    'size' => 'default', // 'main', 'default'
])

@php
    $heightClass = match($size) {
        'main' => 'h-16 md:h-20',
        default => 'h-8 md:h-10',
    };
@endphp

@if($sponsor->website_url)
    <a href="{{ $sponsor->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-block">
        <img
            src="{{ $sponsor->logo_path ? Vite::asset($sponsor->logo_path) : asset('images/sponsors/placeholder.svg') }}"
            alt="{{ $sponsor->name }}"
            class="{{ $heightClass }} {{ $size === 'main' ? 'opacity-80 hover:opacity-100 transition-opacity' : '' }}"
        >
    </a>
@else
    <img
        src="{{ $sponsor->logo_path ? Vite::asset($sponsor->logo_path) : asset('images/sponsors/placeholder.svg') }}"
        alt="{{ $sponsor->name }}"
        class="{{ $heightClass }}"
    >
@endif
