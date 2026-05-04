@php
    $shareUrl = route('home');
    $shareText = __("Don't let them miss out, let's burn together for Jesus!");
    $emailSubject = __('Europe Revival 2026 — Encounter Jesus, Catch on Fire');
    $emailBody = __("I just registered for Europe Revival 2026 in Budapest! Join me — don't miss out, let's burn together for Jesus.\n\n") . $shareUrl;
    $btnBase = 'display:block;max-width:420px;margin:0 auto 12px auto;padding:14px 20px;text-align:center;text-decoration:none;color:#ffffff;font-weight:600;font-size:15px;font-family:Helvetica,Arial,sans-serif;border-radius:12px;';
    $fbHref = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($shareUrl);
    $igHref = 'https://www.instagram.com/';
    $ttHref = 'https://www.tiktok.com/';
    $xHref = 'https://twitter.com/intent/tweet?text=' . urlencode($shareText) . '&url=' . urlencode($shareUrl);
    $mailHref = 'mailto:?subject=' . urlencode($emailSubject) . '&body=' . urlencode($emailBody);
@endphp

<div style="margin:24px 0;text-align:center;font-family:Helvetica,Arial,sans-serif;">

<h3 style="margin:0 0 8px 0;font-size:20px;">{{ __('Share the event with your friends!') }}</h3>

<p style="margin:0 0 20px 0;color:#6b7280;">{{ __("Don't let them miss out, let's burn together for Jesus!") }}</p>

<a href="{{ $fbHref }}" style="{{ $btnBase }}background-color:#1877F2;">{{ __('Share on Facebook') }}</a>

<a href="{{ $igHref }}" style="{{ $btnBase }}background-image:linear-gradient(to right,#833AB4,#E1306C,#FCAF45);background-color:#E1306C;">{{ __('Share on Instagram') }}</a>

<a href="{{ $ttHref }}" style="{{ $btnBase }}background-color:#000000;">{{ __('Share on TikTok') }}</a>

<a href="{{ $xHref }}" style="{{ $btnBase }}background-color:#000000;">{{ __('Share on X') }}</a>

<a href="{{ $mailHref }}" style="{{ $btnBase }}background-color:#374151;border:1px solid #4b5563;">{{ __('Forward by email') }}</a>

</div>
