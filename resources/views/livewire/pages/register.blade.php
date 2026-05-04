<div>
<div class="min-h-screen bg-navy-950">
    {{-- Hero Header --}}
    <div class="relative pt-32 pb-16 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-linear-to-b from-sky-400/10 via-transparent to-navy-950"></div>
            <div class="absolute inset-0 opacity-20" style="background-image: url('{{ asset('images/textures/noise.png') }}');"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            {{-- Badge --}}
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-primary-400 bg-primary-500/10 border border-primary-500/30 rounded-full mb-6">
                October 23-25, 2026 • Budapest
            </span>

            <h1 class="text-4xl md:text-5xl font-bold uppercase mb-4">{!! str_replace(' for ', ' for<br>', __($title)) !!}</h1>
            <p class="text-xl text-white/60">{{ __($subtitle) }}</p>
        </div>
    </div>

    {{-- Registration Form Container --}}
    <div class="relative z-10 px-4 pb-24">
        <div class="max-w-3xl mx-auto">
            {{-- Livewire Registration Form --}}
            <div class="dark fi-navy-form bg-navy-700/50 backdrop-blur-sm rounded-2xl p-8 md:p-10 border border-navy-600">
               <livewire:registration-form :type="$type" />
            </div>

        </div>
    </div>
</div>
</div>
