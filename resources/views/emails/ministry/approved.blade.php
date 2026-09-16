<x-mail::message>
# {{ __('Your Application Has Been Approved!') }}

{{ __('Dear') }} {{ $registration->first_name }},

{{ __('We are delighted to inform you that your application to join the Ministry Team at Europe Revival 2026 has been approved!') }}

{{ __('We are excited to have you serving alongside us at this special event.') }}

<x-mail::panel>
**{{ __('What happens next?') }}**

1. {{ __('You will receive further instructions about training and orientation') }}
2. {{ __('Please save the date and start making travel arrangements') }}
3. {{ __('Keep an eye on your email for important updates') }}
</x-mail::panel>

{{ __('Please join the following WhatsApp groups, as we will be sharing and communicating all information related to the service with you through these groups going forward.') }}

{{ __('Please make sure to join so that you don’t miss any of the latest updates and important information. Thank you!') }}

- [https://chat.whatsapp.com/IHKiCvnyy5Q3fpPytkYBe8?mode=gi_t](https://chat.whatsapp.com/IHKiCvnyy5Q3fpPytkYBe8?mode=gi_t)
- [https://chat.whatsapp.com/HWsGWl1C6oY98CNsh21B73?mode=gi_t](https://chat.whatsapp.com/HWsGWl1C6oY98CNsh21B73?mode=gi_t)

{{ __('If you have any questions, please do not hesitate to reach out to us.') }}

{{ __('We look forward to meeting you!') }}

{{ __('Thanks') }},<br>
{{ config('app.name') }}
</x-mail::message>
