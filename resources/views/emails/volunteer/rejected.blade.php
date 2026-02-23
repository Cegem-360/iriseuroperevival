<x-mail::message>
# Volunteer Application Update

Dear {{ $registration->first_name }},

Thank you for your interest and your application.

Unfortunately, we are unable to accept your application at this time, but we trust that there will be opportunities for cooperation in the future.

If you have any questions, please do not hesitate to reach out to us.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
