<div
    x-data="{
        get value() { return Math.max(5, parseInt($wire.get('data.group_size') || 5, 10)); },
        set(v) {
            const n = Math.max(5, parseInt(v, 10) || 5);
            $wire.set('data.group_size', n);
        },
        decrement() { this.set(this.value - 1); },
        increment() { this.set(this.value + 1); },
    }"
    class="space-y-1"
>
    <label class="block text-sm font-medium text-white/90">
        {{ __('Number of People') }}
        <sup class="text-danger-400">*</sup>
    </label>

    <div class="inline-flex items-stretch h-10 rounded-lg border border-white/10 bg-white/5 overflow-hidden focus-within:ring-2 focus-within:ring-primary-500/40 focus-within:border-primary-500/60">
        <button
            type="button"
            @click="decrement()"
            :disabled="value <= 5"
            class="w-10 flex items-center justify-center text-white/70 hover:bg-white/10 disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
            aria-label="{{ __('Decrease') }}"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/>
            </svg>
        </button>

        <input
            type="text"
            inputmode="numeric"
            pattern="[0-9]*"
            :value="value"
            @input="set($event.target.value)"
            @blur="set($event.target.value)"
            class="w-16 text-center bg-transparent border-0 focus:ring-0 focus:outline-none text-white font-medium"
        />

        <button
            type="button"
            @click="increment()"
            class="w-10 flex items-center justify-center text-white/70 hover:bg-white/10 transition-colors"
            aria-label="{{ __('Increase') }}"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
        </button>
    </div>

    <p class="text-xs text-white/50">
        {{ __('Minimum 5 people. Enter the total number of participants.') }}
    </p>
</div>
