<?php

use damianbal\QuizAPI\Core\Router;
use damianbal\QuizAPI\Core\App;
use damianbal\QuizAPI\Core\Http\Response;
use damianbal\QuizAPI\Core\Http\Request;
use damianbal\QuizAPI\API\Quiz;

include 'vendor/autoload.php';

// ----------------------------------
// Create router
// ----------------------------------
$router = new Router();

// ----------------------------------
// Create Quiz API
// ----------------------------------
$quizAPI = new Quiz();

$quizAPI->addQuiz($quizAPI->createQuiz('Capitals', [
    $quizAPI->createQuizQuestion('What is capital of Poland?', [
        "Warsaw", "Berlin", "Moscow", "London"
    ], 0),
    $quizAPI->createQuizQuestion('What is capital of Germany?', [
        "Warsaw", "Berlin", "Moscow", "London"
    ], 1)
]));
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

$router->get('/api/quiz/@id', function(Request $request) use ($quizAPI) {
    return Response::responseJson($quizAPI->getQuiz($request->param('id')));
});

$router->get('/api/quiz/index', function(Request $request) use ($quizAPI) {
    return Response::responseJson($quizAPI->getAllQuiz());
});

// ----------------------------------
// Create app
// ----------------------------------
$app = new App($router);

// ----------------------------------
// Run the app
// ----------------------------------
$app->run();
