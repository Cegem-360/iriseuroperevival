<div>
<div class="min-h-screen bg-(--alt-navy-deeper) px-4 pt-28 pb-20">
    <div class="max-w-xl mx-auto">
        {{-- Intro --}}
        <div class="text-center mb-10">
            <span class="inline-block px-4 py-1.5 text-xs font-heading font-semibold tracking-[0.2em] uppercase text-(--alt-gold) bg-(--alt-gold)/10 border border-(--alt-gold)/30 rounded-full mb-5">
                {{ __('Donation') }}
            </span>
            <h1 class="font-heading text-3xl md:text-4xl font-bold uppercase tracking-wide text-(--alt-beige) mb-5 text-balance">
                {{ __('Be part of setting Europe ablaze for Jesus again!') }}
            </h1>
            <div class="w-24 h-0.5 bg-linear-to-r from-transparent via-(--alt-gold) to-transparent mx-auto mb-6"></div>
            <div class="space-y-3 text-(--alt-beige-muted) text-base md:text-lg">
                <p>{{ __('At the Europe Revival Christian event we gather to pray together, to worship God and to be strengthened in our faith.') }}</p>
                <p>{{ __('We want as many people as possible to know the love of Jesus and to carry hope into their families and communities.') }}</p>
                <p class="text-(--alt-beige)">{{ __('Your donation helps make the event happen. Every gift counts – thank you for building this mission together with us!') }}</p>
            </div>
        </div>

        {{-- Card donation --}}
        <div class="bg-(--alt-navy-dark)/60 border border-(--alt-beige)/15 rounded-3xl p-6 md:p-8 mb-6">
            <h2 class="font-heading text-xl md:text-2xl font-bold text-(--alt-beige) text-center mb-2">{{ __('Become a supporter of the mission!') }}</h2>
            <p class="text-center text-(--alt-beige-muted) mb-6">{{ __('Choose the amount of your donation.') }}</p>

            <div class="grid grid-cols-2 gap-3 mb-3">
                @foreach (\App\Models\Donation::PRESET_AMOUNTS_HUF as $amount)
                    <button type="button" wire:key="amount-{{ $amount }}" wire:click="selectAmount({{ $amount }})"
                        @class([
                            'rounded-2xl border px-3 py-4 text-center transition-colors',
                            'border-(--alt-gold) bg-(--alt-gold)/15' => ! $isCustom && $selectedAmount === $amount,
                            'border-(--alt-beige)/15 bg-(--alt-navy)/40 hover:border-(--alt-beige)/40' => $isCustom || $selectedAmount !== $amount,
                        ])>
                        <span class="block font-heading text-lg md:text-xl font-bold text-(--alt-beige)">{{ Number::currency($amount, 'HUF', app()->getLocale(), 0) }}</span>
                        <span class="block text-sm text-(--alt-beige-muted)">~{{ \App\Models\Donation::approximateEur($amount) }}</span>
                    </button>
                @endforeach
            </div>

            <button type="button" wire:click="chooseCustom"
                @class([
                    'w-full rounded-2xl border px-3 py-4 font-heading font-bold text-(--alt-beige) transition-colors mb-3',
                    'border-(--alt-gold) bg-(--alt-gold)/15' => $isCustom,
                    'border-(--alt-beige)/15 bg-(--alt-navy)/40 hover:border-(--alt-beige)/40' => ! $isCustom,
                ])>
                {{ __('Enter another amount') }}
            </button>

            @if ($isCustom)
                <div x-data="{ amount: @entangle('customAmount') }" class="mb-3">
                    <div class="flex items-center gap-2 bg-(--alt-navy)/50 border border-(--alt-beige)/20 rounded-xl px-4 py-3">
                        <input type="number" inputmode="numeric" x-model="amount" min="{{ \App\Models\Donation::MIN_AMOUNT_HUF }}" step="1" placeholder="{{ __('Enter amount') }}" autofocus
                            class="bg-transparent text-(--alt-beige) placeholder-(--alt-beige-muted)/40 w-full outline-none text-lg font-heading font-semibold [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                        <span class="text-(--alt-beige-muted) font-medium shrink-0">Ft</span>
                        <span x-show="amount" class="text-(--alt-beige-muted)/70 text-sm shrink-0" x-text="'(~€' + Math.round(parseInt(amount || 0) / {{ (int) config('services.currency.eur_huf_rate') }}) + ')'"></span>
                    </div>
                    @unless ($errors->has('customAmount'))
                        <p class="text-(--alt-beige-muted) text-xs mt-1">{{ __('Minimum :amount', ['amount' => Number::currency(\App\Models\Donation::MIN_AMOUNT_HUF, 'HUF', app()->getLocale(), 0)]) }}</p>
                    @endunless
                </div>
            @endif

            @error('customAmount')
                <p class="text-red-400 text-sm mb-3">{{ $message }}</p>
            @enderror

            <button type="button" wire:click="donate" wire:loading.attr="disabled"
                class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 bg-linear-to-r from-(--alt-gold) to-(--alt-gold-light) text-(--alt-navy-deeper) font-heading font-bold uppercase tracking-wider rounded-full transition-all duration-300 hover:scale-[1.02] disabled:opacity-60">
                <span wire:loading.remove wire:target="donate">{{ __('Continue to donate') }}</span>
                <span wire:loading wire:target="donate">{{ __('Processing...') }}</span>
            </button>

            <p class="flex items-center justify-center gap-2 text-sm text-(--alt-beige-muted) mt-4">
                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                {{ __('Secure online payment via Stripe') }}
            </p>
        </div>

        {{-- Bank transfer --}}
        <div x-data="{ copied: null, copy(key, text) { navigator.clipboard?.writeText(text); this.copied = key; setTimeout(() => this.copied = null, 2000); } }"
            class="bg-(--alt-navy-dark)/60 border border-(--alt-beige)/15 rounded-3xl p-6 md:p-8">
            <h2 class="font-heading text-xl md:text-2xl font-bold text-(--alt-beige) text-center mb-2">{{ __('Bank transfer') }}</h2>
            <p class="text-center text-(--alt-beige-muted) mb-6">{{ __('You can also support the event by bank transfer.') }}</p>

            <dl class="space-y-4">
                <div>
                    <dt class="text-sm text-(--alt-beige-muted)">{{ __('Beneficiary') }}</dt>
                    <dd class="font-heading font-semibold text-(--alt-beige) text-lg">{{ \App\Models\Donation::BANK_ACCOUNT_HOLDER }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-(--alt-beige-muted)">{{ __('Bank account number') }}</dt>
                    <dd class="flex flex-wrap items-center justify-between gap-x-3 gap-y-2">
                        <span class="font-mono font-semibold text-(--alt-beige) text-sm sm:text-lg whitespace-nowrap">{{ \App\Models\Donation::BANK_ACCOUNT_NUMBER }}</span>
                        <button type="button" @click="copy('account', @js(\App\Models\Donation::BANK_ACCOUNT_NUMBER))" class="shrink-0 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-(--alt-gold)/40 text-(--alt-gold) hover:bg-(--alt-gold)/10">
                            <span x-show="copied !== 'account'">{{ __('Copy') }}</span>
                            <span x-show="copied === 'account'" x-cloak>{{ __('Copied!') }}</span>
                        </button>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-(--alt-beige-muted)">{{ __('Payment reference') }}</dt>
                    <dd class="flex items-center justify-between gap-3">
                        <span class="font-mono font-semibold text-(--alt-beige) text-lg">{{ \App\Models\Donation::BANK_TRANSFER_REFERENCE }}</span>
                        <button type="button" @click="copy('reference', @js(\App\Models\Donation::BANK_TRANSFER_REFERENCE))" class="shrink-0 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full border border-(--alt-gold)/40 text-(--alt-gold) hover:bg-(--alt-gold)/10">
                            <span x-show="copied !== 'reference'">{{ __('Copy') }}</span>
                            <span x-show="copied === 'reference'" x-cloak>{{ __('Copied!') }}</span>
                        </button>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
</div>
