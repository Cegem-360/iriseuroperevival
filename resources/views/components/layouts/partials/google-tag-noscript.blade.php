@if ($gtmContainerId = config('services.google.gtm_container_id'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ urlencode($gtmContainerId) }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif
