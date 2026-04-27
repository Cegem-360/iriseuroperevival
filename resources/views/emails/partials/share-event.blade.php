@php
    $shareUrl = route('home');
    $shareText = __("Don't let them miss out, let's burn together for Jesus!");
    $emailSubject = __('Europe Revival 2026 — Encounter Jesus, Catch on Fire');
    $emailBody = __("I just registered for Europe Revival 2026 in Budapest! Join me — don't miss out, let's burn together for Jesus.\n\n") . $shareUrl;
@endphp

---

### {{ __('Share the event with your friends!') }}

{{ __("Don't let them miss out, let's burn together for Jesus!") }}

- [{{ __('Share on Facebook') }}](https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }})
- [{{ __('Share on Instagram') }}](https://www.instagram.com/)
- [{{ __('Share on TikTok') }}](https://www.tiktok.com/)
- [{{ __('Share on X') }}](https://twitter.com/intent/tweet?text={{ urlencode($shareText) }}&url={{ urlencode($shareUrl) }})
- [{{ __('Forward by email') }}](mailto:?subject={{ urlencode($emailSubject) }}&body={{ urlencode($emailBody) }})
