<div>
<div class="min-h-screen py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mb-8">{{ __('Privacy Policy') }}</h1>

        <div class="prose prose-invert prose-stone max-w-none">
            <p class="text-stone-300">{{ __('Last updated') }}: {{ now()->format('F j, Y') }}</p>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Introduction') }}</h2>
            <p class="text-stone-300">
                {{ __('Europe Revival 2026 ("we", "our", or "us") respects your privacy and is committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights.') }}
            </p>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Data We Collect') }}</h2>
            <p class="text-stone-300">{{ __('We may collect the following types of personal data:') }}</p>
            <ul class="text-stone-300 list-disc pl-6 space-y-2">
                <li>{{ __('Identity data (name, title)') }}</li>
                <li>{{ __('Contact data (email address, phone number, address)') }}</li>
                <li>{{ __('Transaction data (payment details, registration information)') }}</li>
                <li>{{ __('Technical data (IP address, browser type, device information)') }}</li>
            </ul>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('How We Use Your Data') }}</h2>
            <p class="text-stone-300">{{ __('We use your personal data to:') }}</p>
            <ul class="text-stone-300 list-disc pl-6 space-y-2">
                <li>{{ __('Process your conference registration') }}</li>
                <li>{{ __('Send you important conference updates') }}</li>
                <li>{{ __('Process payments and refunds') }}</li>
                <li>{{ __('Improve our website and services') }}</li>
            </ul>

            <h2 class="text-2xl font-semibold text-white mt-8 mb-4">{{ __('Contact Us') }}</h2>
            <p class="text-stone-300">
                {{ __('If you have any questions about this privacy policy, please contact us at') }}:
                <a href="mailto:info@europeRevival.com" class="text-amber-400 hover:text-amber-300">info@europeRevival.com</a>
            </p>
        </div>
    </div>
</div>
</div>