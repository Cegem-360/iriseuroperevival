@php
    $body = filled($reason ?? null)
        ? $reason
        : str_replace(':name', $registration->first_name, config('rejection.default'));
@endphp
<x-mail::message>
{!! nl2br(e($body)) !!}
</x-mail::message>
