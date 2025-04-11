<?php

declare(strict_types=1);

namespace FlightCms\App\App\Middleware;

use Flight;

class HeaderSecurityMiddleware {
    public static string $nonce = '';

    public function before() {
        // In development mode, we set the minimum set of secure headers
        // without CSP, which can block necessary JavaScript
        Flight::response()->header('X-Frame-Options', 'SAMEORIGIN');
        Flight::response()->header('X-Content-Type-Options', 'nosniff');
        
        // Add a simple CSP that allows everything in development mode
        if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
            // Maximum allowing CSP for development
            Flight::response()->header('Content-Security-Policy', "default-src * 'unsafe-inline' 'unsafe-eval' data: blob:;");
        } else {
            // In production mode, we can add more strict settings
            // But for now, we leave basic security
            Flight::response()->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");
        }
    }

    /**
     * A simple after method that does nothing
     * When the main functionality is working, we can add functionality
     */
    public static function after() {
        // Empty method to prevent errors
    }
}