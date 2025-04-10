<?php

// Define the base path of the application
define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/lib/autoload.php';

use FlightCms\App\Views\Template;

Flight::register('template', Template::class);

// Load configuration (optional, example)
// Flight::set('flight.config.path', BASE_PATH . '/app/config');

// Register base routes or include route files
// require BASE_PATH . '/app/routes/web.php';

// Basic route example
Flight::route('/', function(){
    echo Flight::template()->render('home', [
        'title' => 'Speed, Security, Minimalism',
        'description' => 'Flight CMS is a modern, lightweight content management system that prioritizes performance, eliminates redundancy, and optimizes every aspect of your website experience.'
    ]);
});

// Start the Flight engine
Flight::start(); 