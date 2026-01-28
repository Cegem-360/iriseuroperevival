<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Europe Revival 2026 - Encounter Jesus. Catch on Fire.')</title>
    <meta name="description" content="@yield('description', 'Europe Revival 2026 - A 3-day conference for everyone seeking revival. October 23-25, 2026 in Budapest, Hungary. Featuring Heidi Baker, Mel Tari, David Gava and more.')">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', 'Europe Revival 2026')">
    <meta property="og:description" content="@yield('description', 'Encounter Jesus. Catch on Fire. October 23-25, 2026 in Budapest.')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:type" content="website">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Styles --}}
    @filamentStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-navy-950 text-white font-sans antialiased">
    {{-- Navigation --}}
    <x-layouts.partials.navigation />

    {{-- Main Content --}}
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-layouts.partials.footer />

    {{-- Video Modal --}}
    <div x-data="{ open: false }"
         x-show="open"
         x-on:open-video-modal.window="open = true"
         x-on:keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4"
         style="display: none;">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/90" @click="open = false"></div>

        {{-- Modal Content --}}
        <div class="relative z-10 w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <button @click="open = false" class="absolute top-4 right-4 z-20 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <iframe x-show="open"
                    :src="open ? 'https://www.youtube.com/embed/YOUR_VIDEO_ID?autoplay=1' : ''"
                    class="w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
    </div>

    @filamentScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
