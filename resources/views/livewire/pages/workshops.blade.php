<div>
<div class="min-h-screen py-24 bg-navy-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-sky-400 bg-sky-400/10 border border-sky-400/30 rounded-full mb-4">
                {{ __('Saturday & Sunday · 16:00–17:30') }}
            </span>
            <h1 class="text-4xl md:text-5xl font-bold uppercase mb-4">{{ __('Workshops') }}</h1>
            <p class="text-xl text-white/50 max-w-2xl mx-auto">{{ __('Choose from a variety of interactive workshops to deepen your faith and equip you for Kingdom impact.') }}</p>
        </div>

        @if($workshops->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-navy-700/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ __('Workshop Details Coming Soon') }}</h3>
                <p class="text-white/50 max-w-md mx-auto">{{ __('We are preparing an amazing lineup of interactive workshops. Stay tuned for announcements!') }}</p>
            </div>
        @else
            <!-- Workshops Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($workshops as $workshop)
                    <div wire:key="workshop-{{ $workshop->id }}" class="group bg-navy-700/50 rounded-xl border border-navy-600 overflow-hidden hover:border-sky-400/30 transition-colors">
                        <div class="p-6 flex flex-col h-full">
                            <!-- Icon & Schedule Badge -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-10 h-10 rounded-lg bg-sky-400/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                @if($workshop->schedule_note)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-ocean-500/10 text-ocean-400 border border-ocean-500/20">
                                        {{ $workshop->schedule_note }}
                                    </span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg font-bold mb-2 group-hover:text-sky-400 transition-colors">
                                {{ Str::before($workshop->title, ' - ') }}
                            </h3>

                            <!-- Short Description -->
                            @if($workshop->short_description)
                                @if(str_contains($workshop->short_description, 'Only those who'))
                                    @php [$desc, $restriction] = explode('Only those', $workshop->short_description, 2); @endphp
                                    <p class="text-white/50 text-sm mb-2">{{ trim($desc) }}</p>
                                    <p class="text-primary-400 text-sm font-medium mb-4">Only those{{ $restriction }}</p>
                                @else
                                    <p class="text-white/50 text-sm mb-4 line-clamp-2">{{ $workshop->short_description }}</p>
                                @endif
                            @endif

                            <div class="mt-auto">
                            <!-- Duration -->
                            @if($workshop->formatted_duration)
                                <div class="flex items-center gap-1.5 text-white/40 text-xs mb-4">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $workshop->formatted_duration }}
                                </div>
                            @endif

                            <!-- Leader -->
                            <div class="flex items-center gap-4 pt-4 border-t border-navy-600">
                                @if($workshop->speaker && $workshop->speaker->photo_path)
                                    <img src="{{ Vite::asset('resources/' . $workshop->speaker->photo_path) }}" alt="{{ $workshop->leader_name }}" class="w-24 h-24 rounded-xl object-cover object-top">
                                @else
                                    <div class="w-24 h-24 rounded-xl bg-sky-400/20 flex items-center justify-center text-sky-400 font-semibold text-2xl">
                                        {{ substr($workshop->leader_name ?? 'W', 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    @if($workshop->speaker)
                                        <a href="{{ route('speaker.show', $workshop->speaker->slug) }}" class="text-white font-medium hover:text-sky-400 transition-colors">
                                            {{ $workshop->leader_name }}
                                        </a>
                                        @if($workshop->speaker->organization)
                                            <p class="text-primary-400 text-xs font-medium">{{ $workshop->speaker->organization }}</p>
                                        @endif
                                    @else
                                        <p class="text-white font-medium">{{ $workshop->leader_name }}</p>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Additional workshops coming soon --}}
                <div class="bg-navy-700/30 rounded-xl border border-navy-600 border-dashed flex items-center justify-center p-8 min-h-64">
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-lg bg-primary-500/10 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <p class="text-white/60 font-semibold">{{ __('Additional workshop topics will be available soon.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <div class="inline-flex flex-col items-center gap-4 p-8 bg-orange-500/15 rounded-2xl border border-orange-500/30 max-w-2xl">
                    <h3 class="text-xl font-semibold">{{ __('Ready to join?') }}</h3>
                    <p class="text-white/60 text-sm">{{ __('Register now to secure your spot in these transformative workshops.') }}</p>
                    <p class="text-primary-400 font-semibold text-base">
                        {{ __('You can sign up for workshops after registering for the event. Before the event, we will send you an email with the details, where you can choose the topic that interests you most.') }}
                    </p>
                    <a href="{{ route('register') }}" class="btn-primary whitespace-nowrap mt-2">
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
