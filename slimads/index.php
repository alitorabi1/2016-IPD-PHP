<?php

require_once 'vendor/autoload.php';

DB::$dbName = 'slimads';
DB::$user = 'slimads';
//DB::$password = "K7cuRhvudtpMxJP8";
DB::$password = "FnsNbTteESvUXGFj";
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
    echo "Welcome to ads Page";
    $adList = DB::query('SELECT * FROM ad');
    $app->render('index.html.twig', array('adList' => $adList));
});

$app->get('/postad', function() use ($app){
    $app->render('postad.html.twig');
});

$app->post('/postad', function() use ($app){
//    echo 'Not implemented yet.';
    $msg = $app->request->post('msg');
    $price = $app->request->post('price');
    $contactEmail = $app->request->post('contactEmail');
    $valueList = array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail);
    $errorList = array();
    if ((strlen($msg) < 5) || (strlen($msg) > 300)) {
        array_push($errorList, "Message must from 5 to 300");
        unset($valueList['message']);
    }
    if ($price == "") {
        array_push($errorList, "Price must be provided");
    } elseif (($price < 0) || ($price > 1000000)) {
        array_push($errorList, "Price must be from 0 to 1000000");
        unset($valueList['price']);
    }
    if ($errorList) {
        $app->render('postad.html.twig', array('errorList' => $errorList, 'v' => $valueList));
    } else {
        DB::insert('ad', array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail));
        $app->render('postad_success.html.twig', array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail));
    }
});

$app->run();
