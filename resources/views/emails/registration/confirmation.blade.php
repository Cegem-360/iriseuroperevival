<x-mail::message>
# {{ __('Thank you for registering') }}

{{ __('Dear') }} {{ $registration->first_name }},

{{ __('Your registration has been received') }}

<x-mail::panel>
**{{ __('Registration Details') }}**

**{{ __('Reference Number') }}:** {{ $registration->uuid }}
**{{ __('Name') }}:** {{ $registration->full_name }}
**{{ __('Email') }}:** {{ $registration->email }}
**{{ __('Ticket Type') }}:** {{ ucfirst($registration->ticket_type ?? 'Standard') }}
@if($registration->amount)
**{{ __('Total') }}:** {{ $registration->formatted_amount }}
@endif
</x-mail::panel>

<x-mail::button :url="$url">
{{ __('View Registration Details') }}
</x-mail::button>

{{ __('You will receive a confirmation email shortly') }}

{{ __('Thanks') }},<br>
Europe Revival 2026
</x-mail::message>
