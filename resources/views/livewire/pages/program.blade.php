<div>
<div class="min-h-screen py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-amber-400 text-sm font-medium mb-4">
                {{ __('August 6-9, 2026') }}
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ __('Conference Program') }}</h1>
            <p class="text-xl text-stone-400 max-w-2xl mx-auto">{{ __('Three days of powerful worship, teaching, and encounters with God.') }}</p>
        </div>

        @if($days->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-stone-800/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">{{ __('Full Schedule Coming Soon') }}</h3>
                <p class="text-stone-400 max-w-md mx-auto">{{ __('We are finalizing an amazing program. Stay tuned for the detailed schedule!') }}</p>
            </div>
        @else
            <!-- Day Tabs -->
            <div class="flex justify-center mb-8">
                <div class="inline-flex bg-stone-900/50 rounded-full p-1 border border-stone-800">
                    @foreach($days as $dayKey => $items)
                        @php
                            $dayDate = \Carbon\Carbon::parse($dayKey);
                        @endphp
                        <button
                            wire:click="setActiveDay('{{ $dayKey }}')"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                                {{ $activeDay === $dayKey
                                    ? 'bg-amber-500 text-white'
                                    : 'text-stone-400 hover:text-white' }}"
                        >
                            <span class="hidden sm:inline">{{ $dayDate->format('l') }}</span>
                            <span class="sm:hidden">{{ $dayDate->format('D') }}</span>
                            <span class="ml-1 text-xs opacity-75">{{ $dayDate->format('M j') }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Schedule Timeline -->
            @foreach($days as $dayKey => $items)
                <div
                    class="{{ $activeDay === $dayKey ? 'block' : 'hidden' }}"
                    wire:key="day-{{ $dayKey }}"
                >
                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-px bg-stone-800 transform md:-translate-x-px"></div>

                        <!-- Schedule Items -->
                        <div class="space-y-8">
                            @foreach($items as $index => $item)
                                @php
                                    $isEven = $index % 2 === 0;
                                    $typeColors = [
                                        'worship' => 'from-purple-500 to-purple-600',
                                        'session' => 'from-amber-500 to-amber-600',
                                        'break' => 'from-stone-500 to-stone-600',
                                        'meal' => 'from-green-500 to-green-600',
                                        'special' => 'from-pink-500 to-pink-600',
                                    ];
                                    $typeIcons = [
                                        'worship' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />',
                                        'session' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
                                        'break' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                                        'meal' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                                        'special' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />',
                                    ];
                                    $bgGradient = $typeColors[$item->type] ?? $typeColors['session'];
                                    $icon = $typeIcons[$item->type] ?? $typeIcons['session'];
                                @endphp

                                <div wire:key="item-{{ $item->id }}" class="relative flex items-start {{ $isEven ? 'md:flex-row-reverse' : '' }}">
                                    <!-- Timeline Dot -->
                                    <div class="absolute left-8 md:left-1/2 w-4 h-4 rounded-full bg-gradient-to-br {{ $bgGradient }} transform -translate-x-1/2 border-4 border-stone-950 z-10"></div>

                                    <!-- Time (Mobile: inline, Desktop: side) -->
                                    <div class="hidden md:block w-1/2 {{ $isEven ? 'pl-12 text-left' : 'pr-12 text-right' }}">
                                        <span class="text-amber-400 font-medium">
                                            {{ $item->start_time->format('H:i') }} - {{ $item->end_time->format('H:i') }}
                                        </span>
                                    </div>

                                    <!-- Content Card -->
                                    <div class="ml-16 md:ml-0 md:w-1/2 {{ $isEven ? 'md:pr-12' : 'md:pl-12' }}">
                                        <div class="bg-stone-900/50 rounded-xl border border-stone-800 p-6 hover:border-amber-500/30 transition-colors">
                                            <!-- Mobile Time -->
                                            <span class="md:hidden text-amber-400 font-medium text-sm block mb-2">
                                                {{ $item->start_time->format('H:i') }} - {{ $item->end_time->format('H:i') }}
                                            </span>

                                            <!-- Type Badge & Title -->
                                            <div class="flex items-start gap-3 mb-3">
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $bgGradient }} flex items-center justify-center shrink-0">
                                                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        {!! $icon !!}
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-bold text-white">{{ $item->title }}</h3>
                                                    @if($item->location)
                                                        <p class="text-stone-500 text-sm flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                            {{ $item->location }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            @if($item->description)
                                                <p class="text-stone-400 text-sm mb-4">{{ $item->description }}</p>
                                            @endif

                                            <!-- Speaker -->
                                            @if($item->speaker)
                                                <div class="flex items-center gap-3 pt-4 border-t border-stone-800">
                                                    @if($item->speaker->photo_path)
                                                        <img src="{{ Storage::url($item->speaker->photo_path) }}" alt="{{ $item->speaker->name }}" class="w-10 h-10 rounded-full object-cover">
                                                    @else
                                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-white font-semibold text-sm">
                                                            {{ substr($item->speaker->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('speaker.show', $item->speaker->slug) }}" class="text-white text-sm font-medium hover:text-amber-400 transition-colors">
                                                            {{ $item->speaker->name }}
                                                        </a>
                                                        @if($item->speaker->title)
                                                            <p class="text-stone-500 text-xs">{{ $item->speaker->title }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Legend -->
            <div class="mt-16 flex flex-wrap justify-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-purple-500 to-purple-600"></div>
                    <span class="text-stone-400 text-sm">{{ __('Worship') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-amber-500 to-amber-600"></div>
                    <span class="text-stone-400 text-sm">{{ __('Session') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-green-500 to-green-600"></div>
                    <span class="text-stone-400 text-sm">{{ __('Meal') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-stone-500 to-stone-600"></div>
                    <span class="text-stone-400 text-sm">{{ __('Break') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-pink-500 to-pink-600"></div>
                    <span class="text-stone-400 text-sm">{{ __('Special') }}</span>
                </div>
            </div>
        @endif
    </div>
</div>
</div>