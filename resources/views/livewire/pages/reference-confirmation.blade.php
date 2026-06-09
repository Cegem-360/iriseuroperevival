<div>
<div class="min-h-screen py-24">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-navy-900 rounded-lg border border-navy-700 p-8">
            @if($submitted || $this->alreadyResponded())
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-primary-500/20 flex items-center justify-center">
                        <svg class="w-8 h-8 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <h1 class="text-3xl font-bold text-white mb-4">Köszönjük! / Thank you!</h1>

                    <p class="text-white/60 mb-2">
                        Köszönjük, hogy időt szánt az ajánlás visszaigazolására. A válaszát rögzítettük.
                    </p>
                    <p class="text-white/60 mb-8">
                        Thank you for taking the time to confirm this reference. Your response has been recorded.
                    </p>

                    <a href="{{ route('home') }}" class="btn-secondary">
                        Vissza a főoldalra / Return Home
                    </a>
                </div>
            @else
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Ajánlás megerősítése</h1>
                    <h2 class="text-xl font-semibold text-white/80">Reference Confirmation</h2>
                </div>

                <div class="bg-navy-800/50 rounded-lg p-6 mb-8">
                    <p class="text-white/80 mb-4">
                        <span class="font-semibold text-white">{{ $registration->full_name }}</span>
                        jelentkezett a Europe Revival 2026 szolgálói csapatába, és Önt ({{ $refereeName }})
                        adta meg ajánlóként.
                    </p>
                    <p class="text-white/80">
                        <span class="font-semibold text-white">{{ $registration->full_name }}</span>
                        has applied to join the Ministry Team at Europe Revival 2026 and listed you
                        ({{ $refereeName }}) as a reference.
                    </p>
                </div>

                <div class="mb-6">
                    <p class="text-white font-semibold mb-1">
                        Megerősíti, hogy ismeri ezt a személyt és vállalja az ajánlását?
                    </p>
                    <p class="text-white/70">
                        Do you confirm that you know this person and are willing to vouch for them?
                    </p>
                </div>

                <div class="mb-8">
                    <label for="comment" class="block text-white/80 mb-2">
                        Megjegyzés (nem kötelező) / Comment (optional)
                    </label>
                    <textarea
                        id="comment"
                        wire:model="comment"
                        rows="5"
                        class="w-full rounded-lg bg-navy-800 border border-navy-700 text-white p-3 focus:border-primary-500 focus:ring-primary-500"
                        placeholder="Írja ide a megjegyzését... / Write your comment here..."
                    ></textarea>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        wire:click="submit(true)"
                        wire:loading.attr="disabled"
                        class="btn-primary"
                    >
                        Igen, vállalom / Yes, I confirm
                    </button>
                    <button
                        wire:click="submit(false)"
                        wire:loading.attr="disabled"
                        class="btn-secondary"
                    >
                        Nem / No, I cannot
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
