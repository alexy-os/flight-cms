<?php

declare(strict_types=1);

namespace FlightCms\App\App\Middleware;

use Flight;

class HeaderSecurityMiddleware {
    public static string $nonce = '';

    public function before() {
        // В режиме разработки устанавливаем минимальный набор безопасных заголовков
        // без CSP, который может блокировать необходимый JavaScript
        Flight::response()->header('X-Frame-Options', 'SAMEORIGIN');
        Flight::response()->header('X-Content-Type-Options', 'nosniff');
        
        // Добавляем простой CSP, разрешающий все в режиме разработки
        if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
            // Максимально разрешающий CSP для разработки
            Flight::response()->header('Content-Security-Policy', "default-src * 'unsafe-inline' 'unsafe-eval' data: blob:;");
        } else {
            // В производственном режиме можно будет добавить более строгие настройки
            // Но пока оставляем базовую безопасность
            Flight::response()->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");
        }
    }

    /**
     * Простой метод after, который просто ничего не делает
     * Когда основное работает, можно будет добавить функционал
     */
    public static function after() {
        // Пустой метод для предотвращения ошибок
    }
}