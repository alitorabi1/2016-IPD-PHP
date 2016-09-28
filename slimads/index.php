<?php

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));


DB::$dbName = 'slimads';
DB::$user = 'slimads';
DB::$password = "K7cuRhvudtpMxJP8";
//DB::$password = "FnsNbTteESvUXGFj";
//DB::$host = '127.0.0.1'; // sometimes needed for MAX
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: ". $params['error']);
    $log->error(" in query: ". $params['query']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query broke
}

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: ". $params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
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

\Slim\Route::setDefaultConditions(array('id' => '\d+'));

$app->get('/', function() use ($app) {
    echo "Welcome to ads Page";
    $adList = DB::query('SELECT * FROM ad');
    $app->render('index.html.twig', array('adList' => $adList));
});

//$app->get('/postad', function() use ($app){
//    $app->render('postad.html.twig');
//});

$app->post('/postad(/:id)', function($id = '') use ($app, $log){
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
        if ($id == '') {
            DB::insert('ad', array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail));
            $id = DB::insertId();
            $log->debug("Ad created with ID=" . $id);
        } else {
            DB::update('ad', array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail), 'ID=%s', $id);
            $log->debug("Ad updateded with ID=" . $id);
        }
        $app->render('postad_success.html.twig', array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail));
    }
});

$app->get('/postad(/:id)', function($id = '') use ($app, $log){
    if ($id === '') {
        $app->render('postad.html.twig');
        return;
    }
    $ad = DB::queryOneRow("SELECT * FROM ad WHERE ID=%d", $id);
    if (!$id) {
        $app->render('editad_notfound.html.twig', array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail));
    } else {
        $app->render('postad.html.twig', array('v' => $ad));
    }
});

//$app->post('/editad/:id', function($id) use ($app){});

$app->run();
