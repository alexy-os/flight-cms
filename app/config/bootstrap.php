<?php

// Удаляем манипуляцию с буферами вывода в начале файла
// ob_start();

use Tracy\Debugger;
use FlightCms\App\Views\Template;
use FlightCms\App\App\Middleware\HeaderSecurityMiddleware;

// --- Essential Constants ---
define('DS', DIRECTORY_SEPARATOR);
// Assuming bootstrap.php is in app/config, BASE_PATH is one level up from app/
define('BASE_PATH', dirname(__DIR__, 2));

// --- Composer Autoloader ---
$autoloader = BASE_PATH . '/lib/autoload.php';
if (!file_exists($autoloader)) {
    die("Composer autoload file not found. Please run 'composer install'.");
}
require $autoloader;

// --- Load Configuration ---
$configLoader = __DIR__ . '/config.php';
if (!file_exists($configLoader)) {
    die("Main configuration loader not found.");
}
$config = require $configLoader;

// --- Error Handling & Debugging (Tracy) ---
// Временно используем стандартный вывод ошибок PHP
ini_set('display_errors', '1');
error_reporting(E_ALL);

// --- Configure Flight ---
foreach ($config['flight'] as $key => $value) {
    Flight::set($key, $value);
}

// --- Register Core Services ---
// Template Engine (adjust class name if different)
// Flight::register('template', Template::class);
Flight::register('template', 'FlightCms\App\Views\Template', [
    BASE_PATH . '/app/views'
], function($template) use ($config) {
    // Базовая конфигурация
});

// Database Connection (using Flight's Container and Active Record)
// Example for Active Record setup (adjust based on your chosen DB library)
if (class_exists('\flight\database\PdoWrapper')) {
    Flight::register('db', \flight\database\PdoWrapper::class, [$config['database']['type'].':'.$config['database']['file']], function($db) {
        // Potentially configure the wrapper further if needed
        // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    });
}

// --- Register Middleware ---
// Регистрируем с самыми базовыми настройками
Flight::register('headerSecurity', 'FlightCms\App\App\Middleware\HeaderSecurityMiddleware');

// Устанавливаем только для production режима, в development можно отключить
// если постоянно возникают ошибки
if (defined('ENVIRONMENT') && ENVIRONMENT !== 'development') {
    Flight::route('*', [Flight::headerSecurity(), 'before'], true);
}

// --- Load Application Routes ---
// Keep routes separate for better organization
$routesFile = BASE_PATH . '/app/routes/web.php'; // Example path
if (file_exists($routesFile)) {
    require $routesFile;
} else {
    // Define a fallback route if no routes file is found
    Flight::route('/', function(){
        echo 'Welcome to FlightCMS! Please define routes in app/routes/web.php';
    });
}

// --- Additional Bootstrap Tasks ---
// Start sessions, load helpers, etc.
// session_start(); // If using native sessions