<?php

use damianbal\QuizAPI\Core\Router;
use damianbal\QuizAPI\Core\App;
use damianbal\QuizAPI\Core\Http\Response;

include 'vendor/autoload.php';

// ----------------------------------
// Create router
// ----------------------------------
$router = new Router();

// ----------------------------------
// Define routes
// ----------------------------------
$router->get('/index', function() {
    return '<b>Siema</b>';
});

// ----------------------------------
// Create app
// ----------------------------------
$app = new App($router);

// ----------------------------------
// Run the app
// ----------------------------------
$app->run();

$r = Response::response("Hello world!");
$r->dispatch();