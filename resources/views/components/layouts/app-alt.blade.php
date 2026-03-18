<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Europe Revival 2026 - Encounter Jesus. Catch on Fire.')</title>
    <meta name="description" content="@yield('description', 'Europe Revival 2026 - A 3-day conference for everyone seeking revival. October 23-25, 2026 in Budapest, Hungary.')">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    {{-- Fonts: Azo Sans (headings via Adobe Fonts) + Abuget (script font) --}}
    <link rel="stylesheet" href="https://use.typekit.net/win4vqd.css">
    <link href="https://fonts.cdnfonts.com/css/abuget" rel="stylesheet">

    {{-- Styles --}}
    @filamentStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] { display: none !important; }

        /* Alt style overrides */
        .font-heading { font-family: 'azo-sans-web', sans-serif; }
        .font-script { font-family: 'Abuget', cursive; }

        /* Beige/cream color tokens */
        :root {
            --alt-beige: #F5E6D0;
            --alt-beige-light: #FAF3EB;
            --alt-beige-muted: #D4C4AE;
            --alt-gold: #C8A050;
            --alt-gold-light: #E0C078;
            --alt-navy: #1E2D4C;
            --alt-navy-dark: #141F35;
            --alt-navy-deeper: #0F1826;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[var(--alt-navy-deeper)] text-[var(--alt-beige)] antialiased font-sans">
    {{-- Navigation --}}
    <x-layouts.partials.navigation />

    {{-- Main Content --}}
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-layouts.partials.footer />

    @filamentScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
