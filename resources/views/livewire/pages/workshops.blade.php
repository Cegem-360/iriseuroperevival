<div>
<div class="min-h-screen py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ __('Workshops') }}</h1>
            <p class="text-xl text-stone-400 max-w-2xl mx-auto">{{ __('Interactive sessions to deepen your understanding and grow in your faith.') }}</p>
        </div>

        @if($workshopLeaders->isEmpty())
            <div class="text-center py-12">
                <p class="text-stone-400">{{ __('Workshop details coming soon.') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($workshopLeaders as $leader)
                    <div class="bg-stone-900 rounded-lg border border-stone-800 p-6">
                        <h3 class="text-xl font-semibold text-white mb-2">{{ $leader->name }}</h3>
                        <p class="text-stone-400">{{ $leader->bio }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</div>