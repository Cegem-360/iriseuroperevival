<x-mail::message>
# Ajánlás kérése / Reference Request

Kedves {{ $referenceName }}!

{{ $registration->full_name }} jelentkezett a Europe Revival 2026 szolgálói csapatába, és Önt adta meg ajánlóként. Hálásak lennénk, ha néhány percet szánna az ajánlás visszaigazolására.

Dear {{ $referenceName }},

{{ $registration->full_name }} has applied to join the Ministry Team at Europe Revival 2026 and has listed you as a reference. We would greatly appreciate it if you could take a few minutes to confirm this reference.

<x-mail::panel>
**Jelentkező adatai / Applicant Information**

**Név / Name:** {{ $registration->full_name }}
**Gyülekezet / Church:** {{ $registration->church_name ?? 'N/A' }}
**Város / City:** {{ $registration->city }}, {{ $registration->country?->value }}
</x-mail::panel>

Kérjük, kattintson az alábbi gombra a megerősítéshez. Az oldalon megjegyzést is hozzáfűzhet.

Please click the button below to confirm. You can also add a comment on the page.

<x-mail::button :url="$confirmUrl">
Megerősítés / Confirm
</x-mail::button>

Ha bármilyen kérdése van, kérjük, vegye fel velünk a kapcsolatot. / If you have any questions, please do not hesitate to contact us.

Köszönjük az idejét és a támogatását! / Thank you for your time and support.

Áldással / Blessings,<br>
{{ config('app.name') }} {{ __('Team') }}
</x-mail::message>
