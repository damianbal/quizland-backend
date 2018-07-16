<?php

// We need that so we can access our REST API from different server
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

// We don't need notices
error_reporting(E_ALL & ~E_NOTICE);

use damianbal\QuizAPI\Core\Router;
use damianbal\QuizAPI\Core\App;
use damianbal\QuizAPI\Core\Http\Response;
use damianbal\QuizAPI\Core\Http\Request;
use damianbal\QuizAPI\API\Quiz;
use damianbal\enterium\DB;
use damianbal\QuizAPI\Entities\Quiz as QuizEntity;
use damianbal\QuizAPI\Core\Utils;

include 'vendor/autoload.php';

$config = include('src/config.php');

// ----------------------------------
// Admin Configuration (remember to change those!)
// ----------------------------------
$adminPassword = "ADMIN_PASSWORD";
$adminToken = "YOUR_KEY";

// connect to database
DB::getInstance()->connect($config['dbname'], $config['host'], $config['user'], $config['pass']);

// ----------------------------------
// Create router
// ----------------------------------
$router = new Router();
-
// ----------------------------------
// Admin password / access
// ----------------------------------


// ----------------------------------
// Define routes
// ----------------------------------

/**
 * Get token
 */
$router->post('/api/auth', function(Request $request) use ($adminToken, $adminPassword) {
    $pass = $request->getRawInput("password");

    if($pass == $adminPassword) {
        return Response::responseJson(["success" => true, "token" => $adminToken]);
    }
    
    return Response::responseJson(["success" => false, "token" => null]);
});

/**
 * Get quiz
 */
$router->get('/api/quiz/@id', function(Request $request) {
    $q = QuizEntity::find($request->param('id'));

    if($q != null) {
        return Response::responseJson(['id' => $q->id, 'title' => $q->title, 'data' => $q->data]);
    }

    return Response::responseJson(['message' => 'Not found'], 404);
});

/**
 * Remove quiz
 */
$router->post('/api/quiz/@id/remove', function(Request $request) use ($adminToken) {
    $q = QuizEntity::find($request->param('id'));

    if($request->getRawInput("token") == $adminToken) {
        $q->delete();
        return Response::responseJson(['success' => true, 'message' => 'Removed!']);
    }
    else {
        return Response::responseJson(['success' => false, 'message' => 'You are not authorized!']);

    }
});

/**
 * Add quiz
 */
$router->post('/api/quiz', function(Request $request) {

    $title = $request->getRawInput('title');
    $data = $request->getRawInput('data');

    // validate
    if(strlen($title) < 3 || strlen($data) < 3) {
        return Response::responseJson(["error" => true, "message" => "Your quiz can't be added!"]);
    }

    $q = QuizEntity::create([
        'title' => $title,
        'data' => $data
    ]);

    $qid = $q->id;

    $q->save();

    return Response::responseJson(['d' => [$title, $data], "error" => false, "message" => "Your quiz has been added :)", 'quiz_id' => $qid], 201);
});

/**
 * Returns quizzes with pagination
 */
$router->get('/api/quiz/page/@page', function(Request $request) {
    $pageId = $request->param('page');

    $perPage = 6;
    $page = $pageId;

    // not the best way, but will do
    $quizzes = QuizEntity::builder()->limit($page * $perPage, $perPage)->get();

    $quizData = Utils::transform($quizzes, ['title', 'id']);

    return Response::responseJson([
        'meta' => [
            'page' => intval($pageId),
            'maxPages' => QuizEntity::builder()->count()/$perPage,
            'perPage' => $perPage
        ],
        'data' => $quizData
    ]);
});

/**
 * Returns all quizzes (only meta information, won't  include data)
 */
$router->get('/api/quiz/index', function(Request $request) {
    $quizAll = QuizEntity::builder()->get();

    $quizData = Utils::transform($quizAll, ['title', 'id']);

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
