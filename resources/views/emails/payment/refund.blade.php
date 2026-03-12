<x-mail::message>
# {{ __('Refund Processed') }}

{{ __('Dear') }} {{ $registration->first_name }},

{{ __('We have processed a refund for your Europe Revival 2026 registration.') }}

<x-mail::panel>
**{{ __('Refund Details') }}**

**{{ __('Reference Number') }}:** {{ $registration->uuid }}
**{{ __('Refund Amount') }}:** {{ $refundAmount }}
</x-mail::panel>

{{ __('The refund should appear in your account within 5-10 business days, depending on your payment method.') }}

{{ __('If you have any questions about this refund, please do not hesitate to contact us.') }}

{{ __('Thanks') }},<br>
{{ config('app.name') }}
</x-mail::message>
