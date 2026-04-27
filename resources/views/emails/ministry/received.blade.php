<x-mail::message>
# {{ __('Ministry Team Application Received') }}

{{ __('Dear') }} {{ $registration->first_name }},

{{ __('Thank you for your interest in serving with us at Europe Revival 2026!') }}

{{ __('We have received your ministry team application and it is now being reviewed by our team.') }}

@include('emails.partials.share-event')

<x-mail::panel>
**{{ __('Application Details') }}**

**{{ __('Reference Number') }}:** {{ $registration->uuid }}
**{{ __('Name') }}:** {{ $registration->full_name }}
**{{ __('Church') }}:** {{ $registration->church_name ?? 'N/A' }}
</x-mail::panel>

{{ __('We will contact you once your application is approved') }}

{{ __('If you have any questions, please do not hesitate to contact us.') }}

{{ __('Thanks') }},<br>
{{ config('app.name') }}
</x-mail::message>
