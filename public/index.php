<?php

// Define the base path of the application
define('BASE_PATH', dirname(__DIR__));

// Include the Flight autoloader
require BASE_PATH . '/lib/flight/autoload.php';

// Load configuration (optional, example)
// Flight::set('flight.config.path', BASE_PATH . '/app/config');

// Register base routes or include route files
// require BASE_PATH . '/app/routes/web.php';

// Basic route example
Flight::route('/', function(){
    echo 'Welcome to Flight CMS!';
});

// Start the Flight engine
Flight::start(); 