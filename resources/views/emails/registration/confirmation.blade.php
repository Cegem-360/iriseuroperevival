<x-mail::message>
# {{ __('Thank you for registering') }}

{{ __('Dear') }} {{ $registration->first_name }},

{{ __('Your registration has been received') }}

@include('emails.partials.share-event')

<x-mail::panel>
**{{ __('Registration Details') }}**

**{{ __('Reference Number') }}:** {{ $registration->uuid }}
**{{ __('Name') }}:** {{ $registration->full_name }}
**{{ __('Email') }}:** {{ $registration->email }}
**{{ __('Ticket Type') }}:** {{ $registration->formatted_ticket_type }}
@if($registration->type === 'attendee' && $registration->ticket_type)
**{{ __('Number of Tickets') }}:** {{ $registration->ticket_quantity }}
**{{ __('Admission for') }}:** {{ __(':count people', ['count' => $registration->admitted_people]) }}
@endif
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
