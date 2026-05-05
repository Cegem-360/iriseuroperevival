@props([
    'sponsor',
    'size' => 'default', // 'main', 'default'
])

@php
    $heightClass = match($size) {
        'main' => 'h-20 md:h-28',
        default => 'h-12 md:h-16',
    };
    $invertNames = ['mighty warrior', 'awakening'];
    $invertClass = collect($invertNames)->contains(fn ($n) => str_contains(strtolower($sponsor->name), $n)) ? 'invert' : '';

    // Handle both Vite assets (resources/...) and storage paths
    if ($sponsor->logo_path) {
        $logoUrl = str_starts_with($sponsor->logo_path, 'resources/')
            ? Vite::asset($sponsor->logo_path)
            : Storage::url($sponsor->logo_path);
    } else {
        $logoUrl = Vite::asset('resources/images/sponsors/placeholder.svg');
    }
@endphp

@if($sponsor->website_url)
    <a href="{{ $sponsor->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-block">
        <img
            src="{{ $logoUrl }}"
            alt="{{ $sponsor->name }}"
            class="{{ $heightClass }} {{ $invertClass }} {{ $size === 'main' ? 'opacity-80 hover:opacity-100 transition-opacity' : '' }}"
        >
    </a>
@else
    <img
        src="{{ $logoUrl }}"
        alt="{{ $sponsor->name }}"
        class="{{ $heightClass }} {{ $invertClass }}"
    >
@endif
