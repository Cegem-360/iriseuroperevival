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
{{--     <meta property="og:image" content="{{ Vite::asset('resources/images/og-image.jpg') }}"> --}}
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

    {{-- Vision Modal (See the Vision) --}}
    <div x-data="{ open: false }"
         x-show="open"
         x-on:open-vision-modal.window="open = true"
         x-on:keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-100 flex items-center justify-center p-4"
         style="display: none;">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="open = false"></div>

        {{-- Modal Content --}}
        <div class="relative z-10 w-full max-w-3xl max-h-[85vh] bg-navy-900 border border-navy-700 rounded-2xl overflow-hidden shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <button @click="open = false" class="absolute top-4 right-4 z-20 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="overflow-y-auto max-h-[85vh] p-8 md:p-10 space-y-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Europe Revival 2026</h2>
                    <p class="text-primary-400 font-medium">Vision, Values, Principles & Background</p>
                </div>

                <div class="space-y-6 text-white/80 leading-relaxed">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">1. Vision</h3>
                        <p>Europe Revival 2026 exists to create space for a deep encounter with Jesus, where lives are marked by the presence of God and believers are stirred to live a laid-down life for the Gospel across Europe. Our heart is not an event for a moment, but a movement of obedience, love, and surrender that continues long after the gathering ends.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">2. Background</h3>
                        <p>The vision for Europe Revival was inspired by the heart, values, and spiritual DNA of Iris Global. It is led by Dominika and Siya Mofele, full-time missionaries with Iris Global, pioneers of the Iris Krakow base in Europe, and founders of the Iris Europe Camps, which became the cradle of the Europe Revival movement.</p>
                        <p class="mt-3">Many of us encountered God deeply through the ministry of Iris Global — particularly in Africa, Mozambique — where we were marked by His presence, simplicity, radical love for Jesus and for the lost. As Europeans, these encounters awakened a deep hunger to see the same fire burn in Europe. Iris Europe Camps first took place during the COVID season, although the vision itself was born earlier — from a longing to see revival not as a concept, but as lived obedience and love relationship with God. What began as small gatherings of hungry hearts grew into a shared conviction: Europe must encounter Jesus again.</p>
                        <p class="mt-3">Europe Revival 2026 flows from that same hunger — a response to what God has already been stirring, and an invitation to go deeper together.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">3. Core Values</h3>

                        <div class="space-y-4 pl-4 border-l-2 border-primary-500/30">
                            <div>
                                <h4 class="font-semibold text-white">It's All About Jesus</h4>
                                <p>At the heart of Europe Revival is a simple desire: to find God and seek Him all over again. We long for pure and simple devotion to Jesus — not familiarity, not form, but hearts fully turned toward Him. Everything we do flows from a desire to know Him, love Him, and respond to His voice.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">Presence Over Program</h4>
                                <p>We intentionally choose presence over structure. Our aim is to create space — a platform — for the Holy Spirit to move freely, for people to encounter God in real and personal ways. We hold our plans, ideas, and agendas loosely, remaining willing to change direction if God leads differently.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">Laid-Down Lives</h4>
                                <p>We believe true revival is seen in transformed hearts and lives marked by pure and simple devotion to Jesus. Our prayer is not for momentary emotion, but for lasting fruit — a fresh revelation of the Gospel, lives surrendered in love, and obedience that flows from intimacy with Him. Every encounter with God calls us outward — to serve, love, and carry the Gospel into our cities and nations.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">Family and Belonging</h4>
                                <p>Europe Revival is not about performance or image. We value authenticity, humility, and spiritual family — a space where people can come as they are, encounter God, and belong without pressure to perform.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">Unity in Diversity</h4>
                                <p>We honor the richness of cultures, nations, and church expressions across Europe. We gather not to promote one stream, but to stand together around Jesus.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">Encounter Leads to Mission</h4>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">4. Our Prayer</h3>
                        <p>Our prayer is that Europe Revival 2026 would be remembered not for its size, but for the depth of God's presence, the softening of hearts, and the sending out of people who say yes to Jesus wherever He leads.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Video Modal (restore when promo video is ready):
    <div x-data="{ open: false }"
         x-show="open"
         x-on:open-video-modal.window="open = true"
         x-on:keydown.escape.window="open = false"
         class="fixed inset-0 z-100 flex items-center justify-center p-4"
         style="display: none;">
        <div class="absolute inset-0 bg-black/90" @click="open = false"></div>
        <div class="relative z-10 w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl">
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
    --}}

    @filamentScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
