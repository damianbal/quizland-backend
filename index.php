<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

error_reporting(E_ALL & ~E_NOTICE);

use damianbal\QuizAPI\Core\Router;
use damianbal\QuizAPI\Core\App;
use damianbal\QuizAPI\Core\Http\Response;
use damianbal\QuizAPI\Core\Http\Request;
use damianbal\QuizAPI\API\Quiz;
use damianbal\enterium\DB;
use damianbal\QuizAPI\Entities\Quiz as QuizEntity;

include 'vendor/autoload.php';

$config = include('src/config.php');

// connect to database
DB::getInstance()->connect($config['dbname'], $config['host'], $config['user'], $config['pass']);


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

$router->get('/api/quiz/@id', function(Request $request) use ($quizAPI) {
    $q = QuizEntity::find($request->param('id'));

    if($q != null) {
        return Response::responseJson(['title' => $q->title, 'data' => $q->data]);
    }

    return Response::responseJson(['message' => 'Not found'], 404);
});

$router->post('/api/quiz', function(Request $request) {

    $title = $request->getRawInput('title');
    $data = $request->getRawInput('data');

    // validate
    /*
    if(strlen($title) < 3 || strlen($data) < 3) {
        return Response::responseJson(["error" => true, "message" => "Your quiz can't be added!"]);
    }*/

    $q = QuizEntity::create([
        'title' => $title,
        'data' => $data
    ]);

    $q->save();

    return Response::responseJson(['d' => [$title, $data], "error" => false, "message" => "Your quiz has been added :)"], 201);
});

$router->get('/api/quiz/index', function(Request $request) {
    $quizAll = QuizEntity::builder()->get();

    $quizData = [];


    foreach ($quizAll as $q) {
        $quizData[] = ['title' => $q->title, 'id' => $q->id];
    }

    return Response::responseJson( $quizData );
});

// ----------------------------------
// Create app
// ----------------------------------
$app = new App($router);

// ----------------------------------
// Run the app
// ----------------------------------
$app->run();
