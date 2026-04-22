<div>
<div class="min-h-screen bg-navy-950">
    {{-- Hero Header --}}
    <div class="relative pt-32 pb-16 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-linear-to-b from-red-500/10 via-transparent to-navy-950"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold tracking-wider uppercase text-red-400 bg-red-500/10 border border-red-500/30 rounded-full mb-6">
                Internal Test — Admin Only
            </span>

            <h1 class="text-4xl md:text-5xl font-bold uppercase mb-4 text-red-300">{{ $title }}</h1>
            <p class="text-xl text-white/60">{{ $subtitle }}</p>
        </div>
    </div>

    {{-- Registration Form Container --}}
    <div class="relative z-10 px-4 pb-24">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6 rounded-xl border-2 border-red-500/60 bg-red-500/10 p-5 text-center">
                <div class="text-sm font-bold uppercase tracking-wider text-red-400">Live Payment Test</div>
                <div class="mt-1 text-white/80">
                    Amount: <strong>{{ config('internal_test.amount_huf') }} Ft</strong>
                    · The registration will be marked <code>is_test = true</code>.
                </div>
            </div>

            <div class="dark fi-navy-form bg-navy-700/50 backdrop-blur-sm rounded-2xl p-8 md:p-10 border border-navy-600">
                <livewire:registration-form-internal-test />
            </div>
        </div>
    </div>
</div>
</div>
