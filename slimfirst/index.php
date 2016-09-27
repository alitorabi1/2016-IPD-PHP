<?php

// enable on-demand class loader
require_once 'vendor/autoload.php';

DB::$dbName = 'slimfirst';
DB::$user = 'slimfirst';
DB::$password = "2wqFafbBZJr87V4S";
//DB::$host = '127.0.0.1'; // sometimes needed for MAX
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function sql_error_handler($params) {
  echo "Error: " . $params['error'] . "<br>\n";
  echo "Query: " . $params['query'] . "<br>\n";
  die; // don't want to keep going if a query broke
}

function nonsql_error_handler($params) {
  echo "Error: " . $params['error'] . "<br>\n";
  die;
}

// instantiate Slim - router in front controller (this file)
// Slim creation and setup
$app = new \Slim\Slim(array('view' => new \Slim\Views\Twig()));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);
$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');

\Slim\Route::setDefaultConditions(array('name' => '[a-zA-Z_]+'));

$app->get('/', function() use ($app) {
    echo "Welcome to slim";
    $personList = DB::query('SELECT * FROM person');
    $app->render('index.html.twig', array('personList' => $personList));
});

$app->get('/sayhello', function() use ($app){
    $app->render('sayhello.html.twig');
});

$app->post('/sayhello', function() use ($app){
//    echo 'Not implemented yet.';
    $name = $app->request->post('name');
    $age = $app->request->post('age');
    $valueList = array('name' => $name, 'age' => $age);
    $errorList = array();
    if (strlen($name) < 2) {
        array_push($errorList, "Name must be at least 2 characters");
        unset($valueList['name']);
    }
    if ($age == "") {
        array_push($errorList, "Age must be provided");
    } elseif (($age < 0) || ($age > 150)) {
        array_push($errorList, "Age must be from 0 to 150");
        unset($valueList['age']);
    }
    if ($errorList) {
        $app->render('sayhello.html.twig', array('errorList' => $errorList, 'v' => $valueList));
    } else {
        $app->render('sayhello_success.html.twig', array('name' => $name, 'age' => $age));
    }
});

$app->get('/hello/:name/:age', function ($name, $age)  use ($app) {
    $app->render('hello.html.twig', array('name' => $name, 'age' => $age));
//    echo "Hello, " . $name . " You are " . $age . " y/o";
DB::insert('person', array('name' => $name, 'age' => $age));
})->conditions(array('age' => '\d+'));

$app->get('/hello/:name/:city', function ($name, $city) {
    echo "Hello, " . $name . " You are from " . $city;
});

$app->run();
