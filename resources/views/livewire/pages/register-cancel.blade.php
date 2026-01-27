<div>
<div class="min-h-screen py-24">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-stone-900 rounded-lg border border-stone-800 p-8">
            <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-amber-500/20 flex items-center justify-center">
                <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white mb-4">{{ __('Payment Cancelled') }}</h1>
            <p class="text-stone-400 mb-8">
                {{ __('Your payment was cancelled. Your registration has been saved and you can complete the payment later.') }}
            </p>

            <div class="bg-stone-800/50 rounded-lg p-6 mb-8 text-left">
                <h2 class="text-lg font-semibold text-white mb-4">{{ __('Registration Details') }}</h2>
                <dl class="space-y-2">
                    <div class="flex justify-between">
                        <dt class="text-stone-400">{{ __('Reference') }}:</dt>
                        <dd class="text-white font-mono">{{ $registration->uuid }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-stone-400">{{ __('Name') }}:</dt>
                        <dd class="text-white">{{ $registration->full_name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-stone-400">{{ __('Email') }}:</dt>
                        <dd class="text-white">{{ $registration->email }}</dd>
                    </div>
                    @if($registration->amount > 0)
                        <div class="flex justify-between">
                            <dt class="text-stone-400">{{ __('Amount') }}:</dt>
                            <dd class="text-white">{{ $registration->formatted_amount }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register.success', $registration->uuid) }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-amber-500 text-stone-900 font-semibold rounded-lg hover:bg-amber-400 transition-colors">
                    {{ __('Try Payment Again') }}
                </a>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-stone-800 text-white font-semibold rounded-lg hover:bg-stone-700 transition-colors">
                    {{ __('Return Home') }}
                </a>
            </div>
        </div>
    </div>
</div>
</div>