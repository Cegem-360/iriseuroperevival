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
    :class="scrolled ? 'bg-stone-950/95 backdrop-blur-lg border-b border-white/5 shadow-lg' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <img src="{{ asset('images/europe-revival-logo.svg') }}" 
                     alt="Europe Revival 2026" 
                     class="h-10 md:h-12 transition-all duration-300"
                     :class="scrolled ? 'h-9 md:h-10' : 'h-10 md:h-12'">
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="#speakers" class="text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    Speakers
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="#theme" class="text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    Theme
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="#schedule" class="text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    Schedule
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="#pricing" class="text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    Pricing
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="#travel" class="text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    Travel
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('workshops') }}" class="text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    Workshops
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('program') }}" class="text-white/70 hover:text-white font-medium text-sm transition-colors relative group">
                    Program
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
            </div>

            {{-- CTA Button --}}
            <div class="hidden lg:flex items-center gap-4">
                {{-- Language Switcher --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-1 text-white/60 hover:text-white text-sm transition-colors">
                        <span>EN</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" 
                         x-transition
                         class="absolute right-0 mt-2 w-24 bg-stone-900 border border-stone-700 rounded-lg shadow-xl overflow-hidden">
                        <a href="?lang=en" class="block px-4 py-2 text-sm text-white/70 hover:bg-stone-800 hover:text-white">English</a>
                        <a href="?lang=hu" class="block px-4 py-2 text-sm text-white/70 hover:bg-stone-800 hover:text-white">Magyar</a>
                        <a href="?lang=de" class="block px-4 py-2 text-sm text-white/70 hover:bg-stone-800 hover:text-white">Deutsch</a>
                    </div>
                </div>

                {{-- Register Button --}}
                <a href="{{ route('register') }}" 
                   class="group inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-stone-900 font-semibold text-sm rounded-full transition-all duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/30">
                    Register Now
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
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
         class="lg:hidden bg-stone-950/98 backdrop-blur-xl border-t border-white/5"
         style="display: none;">
        <div class="max-w-7xl mx-auto px-4 py-6 space-y-4">
            <a href="#speakers" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">Speakers</a>
            <a href="#theme" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">Theme</a>
            <a href="#schedule" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">Schedule</a>
            <a href="#pricing" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">Pricing</a>
            <a href="#travel" @click="mobileMenuOpen = false" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">Travel</a>
            <a href="{{ route('workshops') }}" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">Workshops</a>
            <a href="{{ route('program') }}" class="block py-3 text-white/80 hover:text-white font-medium border-b border-white/5">Program</a>
            
            {{-- Language Options --}}
            <div class="flex items-center gap-4 py-3 border-b border-white/5">
                <span class="text-white/50 text-sm">Language:</span>
                <a href="?lang=en" class="text-amber-400 text-sm font-medium">EN</a>
                <a href="?lang=hu" class="text-white/60 text-sm hover:text-white">HU</a>
                <a href="?lang=de" class="text-white/60 text-sm hover:text-white">DE</a>
            </div>
            
            {{-- Mobile CTA --}}
            <div class="pt-4">
                <a href="{{ route('register') }}" 
                   class="flex items-center justify-center gap-2 w-full px-6 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-stone-900 font-bold rounded-full">
                    Register Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>
