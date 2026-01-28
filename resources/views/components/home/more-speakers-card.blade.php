@props([])

<a href="{{ route('speakers') }}" class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary-500/20 to-primary-600/20 border border-primary-500/30 aspect-[3/4] flex flex-col items-center justify-center group hover:border-primary-500/50 transition-colors">
    <div class="w-16 h-16 bg-primary-500/20 rounded-full flex items-center justify-center mb-4 group-hover:bg-primary-500/30 transition-colors">
        <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
    </div>
    <span class="text-primary-400 font-semibold">More Coming</span>
    <span class="text-white/50 text-sm mt-1">View All Speakers</span>
</a>
