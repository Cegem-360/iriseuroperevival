<x-mail::message>
{{ __('Dear') }} {{ $registration->first_name }},

{{ __('We are pleased to inform you that your volunteer application has been accepted!') }}

{{ __('We will soon send you further details by email regarding your volunteer service.') }}

{{ __('Thank you for joining the team, and we look forward to seeing you at the event!') }}

{{ __('Kind regards,') }}<br>
{{ __('The Iris Europe Revival 2026 Team') }}
</x-mail::message>
