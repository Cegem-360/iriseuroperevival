<x-mail::message>
# {{ __('Payment Confirmed') }}

{{ __('Dear') }} {{ $registration->first_name }},

{{ __('We have received your payment for Europe Revival 2026. Thank you!') }}

<x-mail::panel>
**{{ __('Payment Details') }}**

**{{ __('Reference Number') }}:** {{ $registration->uuid }}
**{{ __('Name') }}:** {{ $registration->full_name }}
**{{ __('Ticket Type') }}:** {{ $registration->formatted_ticket_type }}
**{{ __('Total') }}:** {{ $registration->formatted_amount }}
**{{ __('Payment Date') }}:** {{ $registration->paid_at->format('F j, Y') }}
</x-mail::panel>

<x-mail::button :url="$url">
{{ __('View Registration Details') }}
</x-mail::button>

{{ __('We look forward to seeing you at the conference!') }}

{{ __('Thanks') }},<br>
{{ config('app.name') }}
</x-mail::message>
