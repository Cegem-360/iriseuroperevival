<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">

    <title>@yield('title', 'Ministry Team — Europe Revival 2026')</title>
    <meta name="description" content="@yield('description', 'Ministry Team landing page for Europe Revival 2026. Invitation only.')">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="stylesheet" href="https://use.typekit.net/win4vqd.css">
    <link href="https://fonts.cdnfonts.com/css/abuget" rel="stylesheet">

    @filamentStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] { display: none !important; }

        .font-heading { font-family: 'azo-sans-web', sans-serif; }
        .font-script { font-family: 'Abuget', cursive; }

        @font-face {
            font-family: 'For Winter';
            src: url('{{ asset('fonts/For_Winter.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        .font-winter { font-family: 'For Winter', cursive; }

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
<body class="bg-(--alt-navy-deeper) text-(--alt-beige) antialiased font-sans">
    {{-- Page-specific navigation (no Tickets / Volunteer items, JOIN AS A MINISTRY TEAM CTA) --}}
    <x-layouts.partials.navigation-ministry />

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <x-layouts.partials.footer />

    {{-- Vision Modal — same content as the public layout, kept here so the VISION nav item works locally --}}
    @include('components.layouts.partials.vision-modal')

    @filamentScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
