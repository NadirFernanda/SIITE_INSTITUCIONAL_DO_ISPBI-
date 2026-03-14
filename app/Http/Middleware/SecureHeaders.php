<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    /**
     * Route prefixes that should receive no-store cache headers
     * to prevent sensitive data from being cached by browsers/proxies.
     */
    private array $sensitivePrefixes = ['admin', 'login', 'profile', 'password'];

    public function handle(Request $request, Closure $next): Response
    {
        // Remove PHP version exposure at SAPI level before response is built
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        }

        $response = $next($request);

        // --- Clickjacking protection ---
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // --- MIME-type sniffing protection (OWASP A05 / H004) ---
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // --- Referrer leakage prevention (OWASP A01 / H005) ---
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // --- XSS filter (legacy but still tested by many scanners) ---
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // --- Feature / Permissions policy ---
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=(), usb=(), ' .
            'magnetometer=(), accelerometer=(), gyroscope=(), fullscreen=(self)'
        );

        // --- HSTS: force HTTPS, include all sub-domains, add to preload list ---
        $response->headers->set(
            'Strict-Transport-Security',
            'max-age=31536000; includeSubDomains; preload'
        );

        // --- Cross-origin isolation headers ---
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

        // --- Content Security Policy ---
        // 'unsafe-eval' has been removed to prevent dynamic code execution (XSS vector).
        // 'unsafe-inline' is retained for styles/scripts until a nonce-based approach
        // is adopted; 'base-uri' and 'form-action' are locked to self to block
        // base-tag hijacking and cross-site form submissions.
        $response->headers->set(
            'Content-Security-Policy',
            implode(' ', [
                "default-src 'self';",
                "script-src 'self' 'unsafe-inline';",
                "style-src 'self' 'unsafe-inline';",
                "img-src 'self' data: https:;",
                "font-src 'self' data:;",
                "frame-src https://www.google.com https://www.youtube.com;",
                "connect-src 'self';",
                "object-src 'none';",
                "base-uri 'self';",
                "form-action 'self';",
                "upgrade-insecure-requests;",
            ])
        );

        // --- No-cache for authenticated / sensitive routes ---
        $path = ltrim($request->path(), '/');
        $isSensitive = collect($this->sensitivePrefixes)
            ->contains(fn(string $prefix) => str_starts_with($path, $prefix));

        if ($isSensitive) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, private');
            $response->headers->set('Pragma', 'no-cache');
        }

        // --- Strip server fingerprinting headers ---
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
