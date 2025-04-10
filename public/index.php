<?php

use Tracy\Debugger;
use FlightCms\App\Views\Template;

require dirname(__DIR__, 1) . '/lib/autoload.php';

define('BASE_PATH', dirname(__DIR__));

// Tracy Debugger
Debugger::enable();
Debugger::$logDirectory = BASE_PATH . '/storage/logs';

Flight::register('template', Template::class);

// Load configuration (optional, example)
// Flight::set('flight.config.path', BASE_PATH . '/app/config');

// Register base routes or include route files
// require BASE_PATH . '/app/routes/web.php';

// Basic route example
Flight::route('/', function(){
    // route handler
    bdump('Inside route handler');
    
    echo Flight::template()->render('home', [
        'title' => 'Speed, Security, Minimalism',
        'description' => 'Flight CMS is a modern, lightweight content management system that prioritizes performance, eliminates redundancy, and optimizes every aspect of your website experience.'
    ]);
});

// Start the Flight engine
Flight::start();