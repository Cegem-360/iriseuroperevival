<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class EnsureInternalTestAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($this->isAllowed($request), 404);

        $response = $next($request);

        $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive, nosnippet');

        return $response;
    }

    protected function isAllowed(Request $request): bool
    {
        $expected = config('internal_test.token');

        if (! is_string($expected) || $expected === '') {
            return false;
        }

        $provided = (string) $request->route('secret');

        if (! hash_equals($expected, $provided)) {
            return false;
        }

        $expiresAt = config('internal_test.expires_at');

        if (is_string($expiresAt) && $expiresAt !== '' && Carbon::parse($expiresAt)->isPast()) {
            return false;
        }

        $user = $request->user();

        return $user !== null && $user->is_admin === true;
    }
}
