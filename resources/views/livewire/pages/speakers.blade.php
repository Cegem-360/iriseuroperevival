<div>
<div class="min-h-screen py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ __('Speakers') }}</h1>
            <p class="text-xl text-stone-400 max-w-2xl mx-auto">{{ __('Meet the anointed men and women of God who will be ministering at Europe Revival 2026.') }}</p>
        </div>

        @if($mainSpeakers->isEmpty() && $workshopLeaders->isEmpty())
            <div class="text-center py-12">
                <p class="text-stone-400">{{ __('Speaker announcements coming soon.') }}</p>
            </div>
        @else
            @if($mainSpeakers->isNotEmpty())
                <div class="mb-16">
                    <h2 class="text-2xl font-bold text-white mb-8 text-center">{{ __('Main Speakers') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($mainSpeakers as $speaker)
                            <div class="bg-stone-900 rounded-lg border border-stone-800 p-6 text-center">
                                <h3 class="text-xl font-semibold text-white mb-2">{{ $speaker->name }}</h3>
                                <p class="text-stone-400">{{ $speaker->bio }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($workshopLeaders->isNotEmpty())
                <div>
                    <h2 class="text-2xl font-bold text-white mb-8 text-center">{{ __('Workshop Leaders') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($workshopLeaders as $leader)
                            <div class="bg-stone-900 rounded-lg border border-stone-800 p-4 text-center">
                                <h3 class="text-lg font-semibold text-white mb-1">{{ $leader->name }}</h3>
                                <p class="text-sm text-stone-400">{{ $leader->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
</div>