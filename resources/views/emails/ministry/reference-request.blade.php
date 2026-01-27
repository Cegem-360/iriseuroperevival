<x-mail::message>
# {{ __('Reference Request') }}

{{ __('Dear') }} {{ $referenceName }},

{{ __(':name has applied to join the Ministry Team at Europe Revival 2026 and has listed you as a reference.', ['name' => $registration->full_name]) }}

{{ __('We would greatly appreciate it if you could take a few minutes to provide a reference for this applicant.') }}

<x-mail::panel>
**{{ __('Applicant Information') }}**

**{{ __('Name') }}:** {{ $registration->full_name }}
**{{ __('Church') }}:** {{ $registration->church_name ?? 'N/A' }}
**{{ __('City') }}:** {{ $registration->city }}, {{ $registration->country }}
</x-mail::panel>

{{ __('Please respond to this email with your reference, including:') }}

- {{ __('How long have you known the applicant?') }}
- {{ __('In what capacity do you know them?') }}
- {{ __('Can you vouch for their character and spiritual maturity?') }}
- {{ __('Do you recommend them for ministry service?') }}

{{ __('You can simply reply to this email with your response.') }}

{{ __('If you have any questions, please do not hesitate to contact us.') }}

{{ __('Thank you for your time and support.') }}

{{ __('Blessings') }},<br>
{{ config('app.name') }} {{ __('Team') }}
</x-mail::message>
