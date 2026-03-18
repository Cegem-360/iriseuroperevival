{{-- resources/views/components/navigation.blade.php --}}
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
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="shrink-0">
                <img src="{{ Vite::asset('resources/images/europe-revival-2026-logo.webp') }}"
                     alt="Europe Revival 2026"
                     class="h-16 md:h-20 transition-all duration-300"
                     :class="scrolled ? 'h-12 md:h-14' : 'h-16 md:h-20'"
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}#speakers" class="text-white/70 hover:text-white font-medium text-base transition-colors relative group">
                    {{ __('Speakers') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('workshops') }}" class="text-white/70 hover:text-white font-medium text-base transition-colors relative group">
                    {{ __('Workshops') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('home') }}#schedule" class="text-white/70 hover:text-white font-medium text-base transition-colors relative group">
                    {{ __('Program') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('home') }}#pricing" class="text-white/70 hover:text-white font-medium text-base transition-colors relative group">
                    {{ __('Pricing') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('home') }}#volunteer" class="text-white/70 hover:text-white font-medium text-base transition-colors relative group">
                    {{ __('Join as a Volunteer') }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-500 transition-all group-hover:w-full"></span>
                </a>
            </div>

            {{-- CTA Button --}}
            <div class="hidden lg:flex items-center gap-4">
                {{-- Language Switcher --}}
               {{--  <x-language-switcher variant="dropdown" /> --}}

                {{-- Register Button (temporarily shows modal) --}}
                <button @click="$dispatch('open-registration-modal')"
                   class="group inline-flex items-center gap-2 px-6 py-2.5 bg-linear-to-r from-primary-400 to-primary-600 hover:from-primary-500 hover:to-primary-700 text-navy-900 font-semibold text-base rounded-full transition-all duration-300 shadow-lg shadow-primary-500/20 hover:shadow-primary-500/30 cursor-pointer">
                    {{ __('Register Now') }}
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden w-10 h-10 flex items-center justify-center text-white">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
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
            <a href="{{ route('home') }}#speakers" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Speakers') }}</a>
            <a href="{{ route('workshops') }}" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Workshops') }}</a>
            <a href="{{ route('home') }}#schedule" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Program') }}</a>
            <a href="{{ route('home') }}#pricing" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Pricing') }}</a>
            <a href="{{ route('home') }}#volunteer" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">{{ __('Join as a Volunteer') }}</a>

            {{-- Language Options --}}
            <div class="py-3 border-b border-white/5">
                <x-language-switcher variant="inline" />
            </div>

            {{-- Mobile CTA (temporarily shows modal) --}}
            <div class="pt-4">
                <button @click="mobileMenuOpen = false; $dispatch('open-registration-modal')"
                   class="flex items-center justify-center gap-2 w-full px-6 py-4 bg-linear-to-r from-primary-400 to-primary-600 text-navy-900 font-bold rounded-full cursor-pointer">
                    {{ __('Register Now') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

{{-- Registration Coming Soon Modal (outside header to avoid positioning issues) --}}
<div x-data="{ open: false }"
     @open-registration-modal.window="open = true"
     x-show="open" x-transition.opacity
     class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm"
     @click.self="open = false"
     @keydown.escape.window="open = false"
     style="display: none;">
    <div x-show="open" x-transition
         class="bg-navy-900 border border-white/10 rounded-2xl p-8 md:p-10 max-w-md mx-4 text-center shadow-2xl">
        <div class="w-16 h-16 bg-primary-500/20 rounded-full flex items-center justify-center mx-auto mb-5 border border-primary-500/30">
            <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold mb-3">Registration Opens Soon</h3>
        <p class="text-white/60 mb-6">We're finalizing the details. Stay tuned — registration will be available shortly!</p>
        <button @click="open = false"
                class="px-8 py-3 bg-primary-500 hover:bg-primary-600 text-navy-900 font-semibold rounded-full transition-colors cursor-pointer">
            Got it
        </button>
    </div>
</div>
