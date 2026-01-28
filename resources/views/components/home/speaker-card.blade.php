@props([
    'speaker',
    'showArrow' => true,
])

<a href="{{ route('speaker.show', $speaker->slug) }}" class="speaker-card group">
    <img src="{{ $speaker->photo_path ? asset($speaker->photo_path) : asset('images/speakers/placeholder.webp') }}" alt="{{ $speaker->name }}">
    <div class="speaker-card-content">
        @if($speaker->title)
            <span class="badge-{{ $speaker->is_featured ? 'amber' : 'info' }} mb-2">{{ $speaker->title }}</span>
        @endif
        <h3 class="text-{{ $speaker->is_featured ? 'xl' : 'lg' }} font-bold text-white">{{ $speaker->name }}</h3>
        @if($speaker->organization)
            <p class="text-white/60 text-sm">{{ $speaker->organization }}</p>
        @endif
    </div>
    @if($showArrow)
        <div class="absolute top-4 right-4 w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 z-20">
            <svg class="w-5 h-5 text-navy-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </div>
    @endif
</a>
