@if (config('services.google.gtm_container_id'))
    <div x-data="{
            open: false,
            showDetails: false,
            analytics: false,
            marketing: false,
            init() {
                const stored = window.cookieConsent.read();
                if (stored) {
                    this.analytics = stored.analytics;
                    this.marketing = stored.marketing;
                } else {
                    this.open = true;
                }
            },
            reopen() {
                const stored = window.cookieConsent.read();
                this.analytics = stored ? stored.analytics : false;
                this.marketing = stored ? stored.marketing : false;
                this.showDetails = true;
                this.open = true;
            },
            decide(analytics, marketing) {
                window.cookieConsent.save(analytics, marketing);
                this.analytics = analytics;
                this.marketing = marketing;
                this.open = false;
                this.showDetails = false;
            }
         }"
         x-on:open-cookie-settings.window="reopen()"
         x-show="open"
         x-cloak
         x-transition.opacity
         role="dialog"
         aria-modal="false"
         aria-labelledby="cookie-consent-title"
         class="fixed inset-x-0 bottom-0 z-90 p-4">
        <div class="mx-auto max-w-3xl rounded-2xl border border-(--alt-gold)/20 bg-(--alt-navy) p-6 shadow-2xl">
            <h2 id="cookie-consent-title" class="font-heading text-lg font-bold text-(--alt-beige)">{{ __('We value your privacy') }}</h2>
            <p class="mt-2 text-sm leading-relaxed text-(--alt-beige)/70">
                {{ __('We use cookies to measure traffic and to improve our advertising. You can accept all cookies, reject non-essential ones, or choose which categories to allow.') }}
                <a href="{{ route('privacy') }}" class="underline hover:text-(--alt-gold)">{{ __('Privacy Policy') }}</a>
            </p>

            <div x-show="showDetails" x-collapse class="mt-4 space-y-3">
                <label class="flex items-start gap-3 rounded-lg bg-white/5 p-3">
                    <input type="checkbox" checked disabled class="mt-1">
                    <span>
                        <span class="block text-sm font-semibold text-(--alt-beige)">{{ __('Strictly necessary') }}</span>
                        <span class="block text-xs text-(--alt-beige)/60">{{ __('Required for the website to work (e.g. session, security, language). Always active.') }}</span>
                    </span>
                </label>
                <label class="flex cursor-pointer items-start gap-3 rounded-lg bg-white/5 p-3">
                    <input type="checkbox" x-model="analytics" class="mt-1 accent-(--alt-gold)">
                    <span>
                        <span class="block text-sm font-semibold text-(--alt-beige)">{{ __('Analytics') }}</span>
                        <span class="block text-xs text-(--alt-beige)/60">{{ __('Google Analytics helps us understand how visitors use the website.') }}</span>
                    </span>
                </label>
                <label class="flex cursor-pointer items-start gap-3 rounded-lg bg-white/5 p-3">
                    <input type="checkbox" x-model="marketing" class="mt-1 accent-(--alt-gold)">
                    <span>
                        <span class="block text-sm font-semibold text-(--alt-beige)">{{ __('Marketing') }}</span>
                        <span class="block text-xs text-(--alt-beige)/60">{{ __('Google Ads measures the effectiveness of our ads and may personalise them.') }}</span>
                    </span>
                </label>
            </div>

            <div class="mt-5 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">
                <button type="button" x-show="!showDetails" x-on:click="showDetails = true"
                        class="cursor-pointer rounded-lg px-4 py-2 text-sm font-semibold text-(--alt-beige)/80 underline-offset-4 hover:underline">
                    {{ __('Customise') }}
                </button>
                <button type="button" x-show="showDetails" x-on:click="decide(analytics, marketing)"
                        class="cursor-pointer rounded-lg border border-(--alt-gold)/40 px-4 py-2 text-sm font-semibold text-(--alt-beige) hover:bg-white/10">
                    {{ __('Save preferences') }}
                </button>
                <button type="button" x-on:click="decide(false, false)"
                        class="cursor-pointer rounded-lg border border-(--alt-gold)/40 px-4 py-2 text-sm font-semibold text-(--alt-beige) hover:bg-white/10">
                    {{ __('Reject all') }}
                </button>
                <button type="button" x-on:click="decide(true, true)"
                        class="cursor-pointer rounded-lg bg-(--alt-gold) px-4 py-2 text-sm font-semibold text-(--alt-navy-deeper) hover:bg-(--alt-gold-light)">
                    {{ __('Accept all') }}
                </button>
            </div>
        </div>
    </div>
@endif
