{{-- Language Switcher Component --}}
@props(['variant' => 'dropdown'])

@php
    $currentLocale = app()->getLocale();
    $locales = [
        'en' => ['name' => 'English', 'short' => 'EN', 'flag' => '🇬🇧'],
        'hu' => ['name' => 'Magyar', 'short' => 'HU', 'flag' => '🇭🇺'],
    ];
@endphp

@if($variant === 'dropdown')
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open"
                class="flex items-center gap-1.5 text-white/60 hover:text-white text-sm transition-colors">
            <span>{{ $locales[$currentLocale]['short'] }}</span>
            <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div x-show="open"
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute right-0 mt-2 w-32 bg-navy-900 border border-navy-700 rounded-lg shadow-xl overflow-hidden z-50"
             style="display: none;">
            @foreach($locales as $code => $locale)
                <a href="{{ route('lang.switch', $code) }}"
                   class="flex items-center gap-2 px-4 py-2 text-sm transition-colors {{ $code === $currentLocale ? 'bg-navy-800 text-primary-400' : 'text-white/70 hover:bg-navy-800 hover:text-white' }}">
                    <span>{{ $locale['flag'] }}</span>
                    <span>{{ $locale['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
@else
    {{-- Inline variant for mobile --}}
    <div class="flex items-center gap-4">
        <span class="text-white/50 text-sm">{{ __('Language') }}:</span>
        @foreach($locales as $code => $locale)
            <a href="{{ route('lang.switch', $code) }}"
               class="text-sm font-medium {{ $code === $currentLocale ? 'text-primary-400' : 'text-white/60 hover:text-white' }}">
                {{ $locale['short'] }}
            </a>
        @endforeach
    </div>
@endif
