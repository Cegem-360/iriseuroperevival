<div>
<div class="min-h-screen py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mb-8">{{ __('Terms of Service') }}</h1>

        <div class="prose prose-invert prose-stone max-w-none">
            <p class="text-stone-300">{{ __('Last updated') }}: {{ now()->format('F j, Y') }}</p>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Agreement to Terms') }}</h2>
            <p class="text-stone-300">
                {{ __('By registering for Europe Revival 2026, you agree to be bound by these terms of service. If you do not agree to these terms, please do not register for the conference.') }}
            </p>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Registration and Payment') }}</h2>
            <ul class="text-stone-300 list-disc pl-6 space-y-2">
                <li>{{ __('Registration is confirmed only upon receipt of full payment.') }}</li>
                <li>{{ __('All prices are in Euros (EUR) unless otherwise stated.') }}</li>
                <li>{{ __('Payment processing is handled securely through Stripe.') }}</li>
            </ul>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Cancellation and Refunds') }}</h2>
            <ul class="text-stone-300 list-disc pl-6 space-y-2">
                <li>{{ __('Cancellations made 60+ days before the event: Full refund minus processing fees.') }}</li>
                <li>{{ __('Cancellations made 30-59 days before the event: 50% refund.') }}</li>
                <li>{{ __('Cancellations made less than 30 days before the event: No refund.') }}</li>
                <li>{{ __('Registrations are transferable to another person at no additional cost.') }}</li>
            </ul>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Code of Conduct') }}</h2>
            <p class="text-stone-300">
                {{ __('All attendees are expected to conduct themselves in a respectful and appropriate manner. The organizers reserve the right to remove any attendee whose behavior is disruptive or inappropriate.') }}
            </p>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Liability') }}</h2>
            <p class="text-stone-300">
                {{ __('Europe Revival 2026 and its organizers are not liable for any personal injury, loss, or damage to personal property during the event.') }}
            </p>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Contact') }}</h2>
            <p class="text-stone-300">
                {{ __('For questions about these terms, please contact us at') }}:
                <a href="mailto:info@europeRevival.com" class="text-amber-400 hover:text-amber-300">info@europeRevival.com</a>
            </p>
        </div>
    </div>
</div>
</div>