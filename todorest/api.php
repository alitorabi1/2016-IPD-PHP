<?php

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'todorest';
DB::$user = 'todorest';
DB::$password = 'b27ZsLbNsPbGVqKM';

DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

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

// FIXME: SQL error handling
// FIXME: add monolog

$app = new \Slim\Slim();
\Slim\Route::setDefaultConditions(array (
    'ID' => '\d+'
));

//FIXME: ID is \d+ only

$app->response->headers->set('content-type', 'application/json');

function isTodoValid($todo) {
    // Homework
    return TRUE;
}
$app->get('/todoitems', function() {
    $recordList = DB::query("SELECT * FROM todoitems");
    echo json_encode($recordList, JSON_PRETTY_PRINT);
});

// FIXME 404 if record not found
$app->get('/todoitems/:ID', function($ID) use ($app) {
    $record = DB::queryFirstRow("SELECT * FROM todoitems WHERE ID=%d", $ID);
    if (!$record) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    } else {
        echo json_encode($record, JSON_PRETTY_PRINT);
    }
});

$app->delete('/todoitems/:ID', function($ID) {
    DB::delete('todoitems', "ID=%d", $ID);
    echo 'true';
});

$app->post('/todoitems', function() use ($app) {
    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    //FIXME: verify $record contains all and only fields required with valid values
    if (!isTodoItemValid($record)) {
        $app->response->setStatus(400);
        echo json_encode("Bad request - data validation failed");
        return;
    }
    DB::insert('todoitems', $record);
    echo DB::insertId();
    //POST / INSERT is special - returns 201
    $app->response->setStatus(201);
});

$app->put('/todoitems/:ID', function($ID) use ($app) {
    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    $record['ID'] = $ID;
    //FIXME: verify $record contains all and only fields required with valid values
    if (!isTodoItemValid($record)) {
        $app->response->setStatus(400);
        echo json_encode("Bad request - data validation failed");
        return;
    }
    DB::update('todoitems', $record, "ID=%d", $ID);
    echo json_encode(TRUE); // = echo 'true';
});

$app->run();