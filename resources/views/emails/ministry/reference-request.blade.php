<x-mail::message>
# {{ __('Reference Request') }}

{{ __('Dear') }} {{ $referenceName }},

{{ __(':name has applied to join the Ministry Team at Europe Revival 2026 and has listed you as a reference. We would greatly appreciate it if you could take a few minutes to confirm this reference.', ['name' => $registration->full_name]) }}

<x-mail::panel>
**{{ __('Applicant Information') }}**

**{{ __('Name') }}:** {{ $registration->full_name }}
**{{ __('Church') }}:** {{ $registration->church_name ?? 'N/A' }}
**{{ __('City') }}:** {{ $registration->city }}, {{ $registration->country?->value }}
</x-mail::panel>

{{ __('Please click the button below to confirm. You can also add a comment on the page.') }}

<x-mail::button :url="$confirmUrl">
{{ __('Confirm') }}
</x-mail::button>

{{ __('If you have any questions, please do not hesitate to contact us.') }}

{{ __('Thank you for your time and support.') }}

{{ __('Blessings') }},<br>
{{ config('app.name') }} {{ __('Team') }}
</x-mail::message>
