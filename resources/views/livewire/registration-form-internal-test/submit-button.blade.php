<button type="submit"
        wire:loading.attr="disabled"
        x-bind:disabled="! $wire.data?.accepts_terms"
        class="fi-btn fi-btn-size-md relative inline-flex items-center justify-center gap-1.5 px-4 py-2 font-bold outline-none transition duration-75
               bg-linear-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white rounded-lg shadow-lg
               disabled:opacity-50 disabled:cursor-not-allowed">
    <span wire:loading.remove>Proceed to Live Payment ({{ config('internal_test.amount_huf') }} Ft)</span>
    <span wire:loading class="inline-flex items-center gap-2">
        <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Processing...
    </span>
</button>
