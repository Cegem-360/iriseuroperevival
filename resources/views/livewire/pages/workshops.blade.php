<div>
<div class="min-h-screen py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-amber-400 text-sm font-medium mb-4">
                {{ __('Interactive Sessions') }}
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ __('Workshops') }}</h1>
            <p class="text-xl text-stone-400 max-w-2xl mx-auto">{{ __('Interactive sessions to deepen your understanding and grow in your faith.') }}</p>
        </div>

        @if($workshops->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-stone-800/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">{{ __('Workshop Details Coming Soon') }}</h3>
                <p class="text-stone-400 max-w-md mx-auto">{{ __('We are preparing an amazing lineup of interactive workshops. Stay tuned for announcements!') }}</p>
            </div>
        @else
            <!-- Workshops Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($workshops as $workshop)
                    <div wire:key="workshop-{{ $workshop->id }}" class="group bg-stone-900/50 rounded-2xl border border-stone-800 overflow-hidden hover:border-amber-500/30 transition-all duration-300">
                        <!-- Workshop Image -->
                        @if($workshop->image_path)
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ Storage::url($workshop->image_path) }}" alt="{{ $workshop->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="aspect-video bg-gradient-to-br from-amber-500/20 to-stone-800 flex items-center justify-center">
                                <svg class="w-16 h-16 text-amber-500/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif

                        <div class="p-6">
                            <!-- Badges -->
                            <div class="flex items-center gap-2 mb-3">
                                @if($workshop->difficulty_level !== 'all')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($workshop->difficulty_level === 'beginner') bg-green-500/10 text-green-400 border border-green-500/20
                                        @elseif($workshop->difficulty_level === 'intermediate') bg-yellow-500/10 text-yellow-400 border border-yellow-500/20
                                        @else bg-red-500/10 text-red-400 border border-red-500/20
                                        @endif">
                                        {{ ucfirst($workshop->difficulty_level) }}
                                    </span>
                                @endif
                                @if($workshop->formatted_duration)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-stone-800 text-stone-300">
                                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $workshop->formatted_duration }}
                                    </span>
                                @endif
                                @if($workshop->capacity)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-stone-800 text-stone-300">
                                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        {{ $workshop->capacity }}
                                    </span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition-colors">
                                {{ $workshop->title }}
                            </h3>

                            <!-- Short Description -->
                            @if($workshop->short_description)
                                <p class="text-stone-400 text-sm mb-4 line-clamp-2">{{ $workshop->short_description }}</p>
                            @endif

                            <!-- Speaker -->
                            @if($workshop->speaker)
                                <div class="flex items-center gap-3 pt-4 border-t border-stone-800">
                                    @if($workshop->speaker->photo_path)
                                        <img src="{{ Storage::url($workshop->speaker->photo_path) }}" alt="{{ $workshop->speaker->name }}" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ substr($workshop->speaker->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-white text-sm font-medium">{{ $workshop->speaker->name }}</p>
                                        @if($workshop->speaker->title)
                                            <p class="text-stone-500 text-xs">{{ $workshop->speaker->title }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Benefits -->
                            @if($workshop->benefits && count($workshop->benefits) > 0)
                                <div class="mt-4 pt-4 border-t border-stone-800">
                                    <p class="text-xs text-stone-500 uppercase tracking-wider mb-2">{{ __('What you\'ll learn') }}</p>
                                    <ul class="space-y-1">
                                        @foreach(array_slice($workshop->benefits, 0, 3) as $benefit)
                                            <li class="flex items-start gap-2 text-sm text-stone-400">
                                                <svg class="w-4 h-4 text-amber-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                {{ $benefit }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <div class="inline-flex flex-col sm:flex-row items-center gap-4 p-6 bg-stone-900/50 rounded-2xl border border-stone-800">
                    <div class="text-left">
                        <h3 class="text-lg font-semibold text-white">{{ __('Ready to join?') }}</h3>
                        <p class="text-stone-400 text-sm">{{ __('Register now to secure your spot in these transformative workshops.') }}</p>
                    </div>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-full hover:from-amber-600 hover:to-amber-700 transition-all whitespace-nowrap">
                        {{ __('Register Now') }}
                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
</div>