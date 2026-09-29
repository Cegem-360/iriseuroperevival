@php
    $ga4MeasurementId = config('services.google.ga4_measurement_id');
    $adsId = config('services.google.ads_id');
    $adsTicketLabel = config('services.google.ads_ticket_label');
    $primaryTagId = $ga4MeasurementId ?: $adsId;
@endphp

@if ($primaryTagId)
    {{-- Google Consent Mode v2: everything non-essential is denied until the visitor decides --}}
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}

        gtag('consent', 'default', {
            ad_storage: 'denied',
            ad_user_data: 'denied',
            ad_personalization: 'denied',
            analytics_storage: 'denied',
            functionality_storage: 'granted',
            personalization_storage: 'denied',
            security_storage: 'granted',
            wait_for_update: 500
        });
        gtag('set', 'ads_data_redaction', true);
        gtag('set', 'url_passthrough', true);

        window.cookieConsent = {
            storageKey: 'er_cookie_consent',
            version: 1,
            read() {
                try {
                    const stored = JSON.parse(localStorage.getItem(this.storageKey));
                    return stored && stored.version === this.version ? stored : null;
                } catch (e) {
                    return null;
                }
            },
            apply(preferences) {
                const state = (granted) => granted ? 'granted' : 'denied';
                gtag('consent', 'update', {
                    analytics_storage: state(preferences.analytics),
                    ad_storage: state(preferences.marketing),
                    ad_user_data: state(preferences.marketing),
                    ad_personalization: state(preferences.marketing),
                    personalization_storage: state(preferences.marketing)
                });
            },
            save(analytics, marketing) {
                const preferences = { version: this.version, analytics, marketing, updatedAt: new Date().toISOString() };
                try {
                    localStorage.setItem(this.storageKey, JSON.stringify(preferences));
                } catch (e) {}
                this.apply(preferences);
                return preferences;
            }
        };

        const storedConsent = window.cookieConsent.read();
        if (storedConsent) {
            window.cookieConsent.apply(storedConsent);
        }

        gtag('js', new Date());
        @if ($ga4MeasurementId)
        gtag('config', @js($ga4MeasurementId));
        @endif
        @if ($adsId)
        gtag('config', @js($adsId));
        @endif

        window.addEventListener('open-cooltix-modal', () => {
            gtag('event', 'begin_checkout', { currency: 'HUF' });
            @if ($adsId && $adsTicketLabel)
            gtag('event', 'conversion', { send_to: @js($adsId.'/'.$adsTicketLabel) });
            @endif
        });
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ urlencode($primaryTagId) }}"></script>
@endif
