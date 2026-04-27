<x-mail::message>
# {{ __('Thank you for your ticket purchase') }}

{{ __('Dear') }} {{ $registration->first_name }},

{{ __('Thank you for purchasing your ticket for Europe Revival 2026. We can\'t wait to see you there!') }}

@include('emails.partials.share-event')

<x-mail::panel>
**{{ __('Your Ticket') }}**

**{{ __('Reference Number') }}:** {{ $registration->uuid }}
**{{ __('Name') }}:** {{ $registration->full_name }}
**{{ __('Email') }}:** {{ $registration->email }}
**{{ __('Ticket Type') }}:** {{ $registration->formatted_ticket_type }}
@if($registration->amount)
**{{ __('Total') }}:** {{ $registration->formatted_amount }}
@endif
</x-mail::panel>

<x-mail::button :url="$url">
{{ __('View Registration Details') }}
</x-mail::button>

{{ __('Event') }}: **October 22-25, 2026 — Budapest, Hungary**

{{ __('Please keep this email for your records. You will receive further event information closer to the date.') }}

{{ __('Thanks') }},<br>
Europe Revival 2026
</x-mail::message>
