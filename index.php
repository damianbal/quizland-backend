<?php

use damianbal\QuizAPI\Core\Router;
use damianbal\QuizAPI\Core\App;
use damianbal\QuizAPI\Core\Http\Response;
use damianbal\QuizAPI\Core\Http\Request;

include 'vendor/autoload.php';

// ----------------------------------
// Create router
// ----------------------------------
$router = new Router();

// ----------------------------------
// Define routes
// ----------------------------------
$router->get('/index', function() {
    return Response::response("Witaj w domu");
});

$router->get('/music', function() {
    return Response::response(("Ale tutaj nie ma zadnej muzyki :("));
});

$router->get('/ksiazka/@id', function(Request $request) {
    $id = $request->param('id');

    return Response::response("No i pieknie wybrales ksiazke o numerze " . $id);
});

$router->post('/film/@id', function(Request $request) {
    return Response::responseJson(['film_id' => $request->param('id')]);
});

// ----------------------------------
// Create app
// ----------------------------------
$app = new App($router);

// ----------------------------------
// Run the app
// ----------------------------------
$app->run();
