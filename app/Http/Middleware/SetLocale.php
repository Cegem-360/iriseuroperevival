<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported locales for the application.
     *
     * @var array<string>
     */
    protected array $supportedLocales = ['en', 'hu', 'de'];

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request):Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->determineLocale($request);

        App::setLocale($locale);

        return $next($request);
    }

    /**
     * Determine the locale from session, browser, or default.
     */
    protected function determineLocale(Request $request): string
    {
        // First, check session
        $sessionLocale = $request->session()->get('locale');
        if ($sessionLocale && in_array($sessionLocale, $this->supportedLocales)) {
            return $sessionLocale;
        }

        // Then, try to detect from browser
        $browserLocale = $request->getPreferredLanguage($this->supportedLocales);
        if ($browserLocale && in_array($browserLocale, $this->supportedLocales)) {
            return $browserLocale;
        }

        // Default to English
        return config('app.locale', 'en');
    }
}
