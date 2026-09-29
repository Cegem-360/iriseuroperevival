@if ($gtmContainerId = config('services.google.gtm_container_id'))
    {{-- Google Consent Mode v2: everything non-essential is denied until the visitor decides. Must run before GTM loads. --}}
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}

        gtag('consent', 'default', {
            ad_storage: 'granted',
            ad_user_data: 'granted',
            ad_personalization: 'granted',
            analytics_storage: 'granted',
            functionality_storage: 'granted',
            personalization_storage: 'granted',
            security_storage: 'granted'
        });
        gtag('consent', 'default', {
            ad_storage: 'denied',
            ad_user_data: 'denied',
            ad_personalization: 'denied',
            analytics_storage: 'denied',
            functionality_storage: 'granted',
            personalization_storage: 'denied',
            security_storage: 'granted',
            wait_for_update: 500,
            region: ['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'IS', 'LI', 'NO', 'GB', 'CH']
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
                dataLayer.push({ event: 'cookie_consent_update', consent_analytics: preferences.analytics, consent_marketing: preferences.marketing });
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

        window.addEventListener('open-cooltix-modal', () => {
            dataLayer.push({ ecommerce: null });
            dataLayer.push({ event: 'begin_checkout', ecommerce: { currency: 'HUF' } });
        });
    </script>

    {{-- Google Tag Manager --}}
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer',@js($gtmContainerId));</script>
@endif
