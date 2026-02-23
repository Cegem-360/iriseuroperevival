<div>
    {{-- Hero Header --}}
    <section class="relative pt-32 pb-16 bg-navy-950 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-linear-to-b from-navy-950/50 to-navy-950"></div>
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('{{ Vite::asset('resources/images/textures/noise.png') }}'); background-repeat: repeat;">
            </div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <span
                class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-primary-400 bg-primary-400/10 border border-primary-400/30 rounded-full mb-4">
                Sign Up
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $this->getActivityTitle() }}</h1>
            <p class="text-white/60 text-lg max-w-2xl mx-auto">{{ $this->getActivityDescription() }}</p>
        </div>
    </section>

    {{-- Sign Up Form --}}
    <section class="py-16 bg-navy-900">
        <div class="max-w-lg mx-auto px-4">
            <div class="bg-navy-800/50 border border-navy-600 rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Register Your Interest</h2>
                <livewire:activity-signup-form :activity-type="$activity" />
            </div>
        </div>
    </section>
</div>
