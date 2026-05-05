<div>
{!! __('I have read and agree to the :terms and :privacy', [
    'terms' => '<a href="' . route('terms') . '" target="_blank" class="text-primary-400 hover:underline">' . __('Terms of Service') . '</a>',
    'privacy' => '<a href="' . route('privacy') . '" target="_blank" class="text-primary-400 hover:underline">' . __('Privacy Policy') . '</a>',
]) !!}
</div>
