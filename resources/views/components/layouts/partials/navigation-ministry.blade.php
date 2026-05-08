{{-- Ministry-team-only navigation. Cross-links to the public site for SPEAKERS / WORKSHOPS / PROGRAM (Option 1 from the client brief), keeps the Vision modal local, and the right-side CTA jumps to the in-page apply form. --}}
@php
    $publicSite = 'https://iriseuroperevival.com';
@endphp
<header x-data="{
    scrolled: false,
    mobileMenuOpen: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 50;
        });
    }
}"
    :class="scrolled ? 'bg-navy-950/95 backdrop-blur-lg border-b border-white/5 shadow-lg' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between h-24">
            {{-- Logo (no link to home — the page is invitation-only and shouldn't expose itself by linking back) --}}
            <a href="{{ $publicSite }}" class="shrink-0">
                <img src="{{ Vite::asset('resources/images/iris-logo-white.webp') }}"
                     alt="Europe Revival 2026"
                     class="h-16 md:h-18 opacity-90 transition-all duration-300"
                     :class="scrolled ? 'h-12 md:h-14' : 'h-16 md:h-18'">
            </a>

            {{-- Desktop Navigation: VISION (modal) + 3 cross-links to the public site --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="#" @click.prevent="$dispatch('open-vision-modal')" class="uppercase tracking-wider text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    {{ __('Vision') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ $publicSite }}/#speakers" class="uppercase tracking-wider text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    {{ __('Speakers') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ $publicSite }}/#workshops" class="uppercase tracking-wider text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    {{ __('Workshops') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ $publicSite }}/#schedule" class="uppercase tracking-wider text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    {{ __('Program') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
            </div>

            {{-- CTA: Join as a Ministry Team --}}
            <div class="hidden lg:flex items-center gap-4">
                <x-language-switcher variant="dropdown" />

                <a href="#apply"
                   class="group inline-flex items-center gap-2 px-6 py-2.5 bg-[#EE9B14] hover:bg-[#d88b10] text-white font-semibold text-base rounded-full transition-all duration-300 shadow-lg shadow-[#EE9B14]/20 hover:shadow-[#EE9B14]/30">
                    {{ __('Join as a Ministry Team') }}
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Mobile CTA + Menu --}}
            <div class="lg:hidden flex items-center gap-3">
                <a href="#apply"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#EE9B14] hover:bg-[#d88b10] text-white font-semibold text-sm rounded-full transition-all duration-300 shadow-lg shadow-[#EE9B14]/20">
                    {{ __('Join') }}
                </a>
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="w-10 h-10 flex items-center justify-center text-white">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                </button>
            </div>
        </nav>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-navy-950/98 backdrop-blur-xl border-t border-white/5"
         style="display: none;">
        <div class="max-w-7xl mx-auto px-4 py-6 space-y-4">
            <button @click="$dispatch('open-vision-modal'); mobileMenuOpen = false" class="block py-3 uppercase tracking-wide text-white/80 hover:text-white font-medium border-b border-white/5 w-full text-left">{{ __('Vision') }}</button>
            <a href="{{ $publicSite }}/#speakers" @click="mobileMenuOpen = false" class="block py-3 uppercase tracking-wide text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Speakers') }}</a>
            <a href="{{ $publicSite }}/#workshops" @click="mobileMenuOpen = false" class="block py-3 uppercase tracking-wide text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Workshops') }}</a>
            <a href="{{ $publicSite }}/#schedule" @click="mobileMenuOpen = false" class="block py-3 uppercase tracking-wide text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Program') }}</a>

            <div class="py-3 border-b border-white/5">
                <x-language-switcher variant="inline" />
            </div>

            <div class="pt-4">
                <a href="#apply" @click="mobileMenuOpen = false"
                   class="flex items-center justify-center gap-2 w-full px-6 py-4 bg-[#EE9B14] hover:bg-[#d88b10] text-white font-bold rounded-full">
                    {{ __('Join as a Ministry Team') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>
