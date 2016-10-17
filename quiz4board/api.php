<?php

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'quiz4board';
DB::$user = 'quiz4board';
DB::$password = 'tBqzZeXwvSePhEYu';
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

// FIXME: add monolog

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: " . $params['error']);
    http_response_code(500);
    header('content-type: application/json');
    echo json_encode("Internal server error");
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: " . $params['error']);
    $log->error(" in query: " . $params['query']);
    http_response_code(500);
    header('content-type: application/json');
    echo json_encode("Internal server error");
    die; // don't want to keep going if a query broke
}

$app = new \Slim\Slim();

\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+'
));

$app->response->headers->set('content-type', 'application/json');

function isTodoItemValid($todo, &$error, $skipID = FALSE) {
    if (count($todo) != ($skipID ? 3 : 4)) {
        $error = 'Invalid number of fields in data provided';
        return FALSE;
    }
    if (!$skipID) {
        if ((!isset($todo['ID']) || (!is_numeric($todo['ID'])))) {
            $error = 'ID must be provided and must be a number';
            return FALSE;
        }
    }
    if (!isset($todo['sellerName']) || !isset($todo['price']) || !isset($todo['description'])) {
        $error = 'The passed fields do not correspond to the expected list';
        return FALSE;
    }
    if (strlen($todo['sellerName']) < 1 || strlen($todo['sellerName']) > 50) {
        $error = 'Seller Name is not valid';
        return FALSE;
    }
    if ((!is_numeric($todo['price'])) || (count($todo['price']) == 0)) {
        $error = 'Price must be provided and must be a number';
        return FALSE;
    }
    if (strlen($todo['description']) < 5 || strlen($todo['description']) > 500) {
        $error = 'Description Name is not valid';
        return FALSE;
    }
    return TRUE;
}

$app->get('/todoitems', function() {
    $recordList = DB::query("SELECT * FROM messages");
    echo json_encode($recordList, JSON_PRETTY_PRINT);
});

$app->delete('/todoitems/:ID', function($ID) {
    DB::delete('messages', "ID=%d", $ID);
    echo 'true';
});

$app->post('/todoitems', function() use ($app, $log) {
    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    // FIXME: verify $record contains all and only fields required with valid values
    if (!isTodoItemValid($record, $error, TRUE)) {
        $app->response->setStatus(400);
        $log->debug("POST /todoitems verification failed: " . $error);
        echo json_encode($error);
        //echo json_encode("Bad request - data validation failed");
        return;
    }
    DB::insert('messages', $record);
    echo DB::insertId();
    // POST / INSERT is special - returns 201
    $app->response->setStatus(201);
});

$app->run();