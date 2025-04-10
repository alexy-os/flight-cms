<?php

// Define the base path of the application
define('BASE_PATH', dirname(__DIR__));

// Include the Flight autoloader
require BASE_PATH . '/lib/flight/autoload.php';

// Автозагрузка Composer
require BASE_PATH . '/lib/autoload.php';

// Импортируем класс шаблонизатора
use FlightCms\App\Views\Template;

// Создаем экземпляр шаблонизатора и регистрируем в Flight
Flight::register('template', Template::class);

// Load configuration (optional, example)
// Flight::set('flight.config.path', BASE_PATH . '/app/config');

// Register base routes or include route files
// require BASE_PATH . '/app/routes/web.php';

// Basic route example
Flight::route('/', function(){
    // Рендеринг шаблона home.latte с передачей параметров
    echo Flight::template()->render('home', [
        'title' => 'Speed, Security, Minimalism',
        'description' => 'Flight CMS is a modern, lightweight content management system that prioritizes performance, eliminates redundancy, and optimizes every aspect of your website experience.'
    ]);
});

// Start the Flight engine
Flight::start(); 