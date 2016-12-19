<?php

// enable on-demand class loader
require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'slimads';
DB::$user = 'slimads';
DB::$password = '9HJehUBjrxXb6D3h';
// DB::$host = '127.0.0.1'; // sometimes needed on Mac OSX
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: " . $params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: " . $params['error']);
    $log->error(" in query: " . $params['query']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query broke
}

// instantiate Slim - router in front controller (this file)
// Slim creation and setup
$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig()
        ));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);
$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');

\Slim\Route::setDefaultConditions(array(
    'id' => '\d+'
));

$app->get('/', function() use ($app) {
    $adList = DB::query("SELECT * FROM ad");
    $app->render('index.html.twig', array('adList' => $adList));
});

//Submition
$app->post('/postad(/:id)', function($id = '') use ($app, $log) {
    $message = $app->request->post('msg');
    $price = $app->request->post('price');
    $contactEmail = $app->request->post('contactEmail');

    $valueList = array(
        'msg' => $message,
        'price' => $price,
        'contactEmail' => $contactEmail);
    // $name = $_POST['name']; // pure-PHP way - NOT recommended
    $errorList = array();

    if (strlen($message) < 5 || strlen($message) > 300) {
        array_push($errorList, "Message must be at least 5 and at most 300 characters long");
        // unset($valueList['msg']);
    }

    if (($price == "") || !is_numeric($price) || ($price < 0) || ($price > 1000000)) {
        array_push($errorList, "Price must be provided and between 0 and 1000000");
        unset($valueList['price']);
    }

    if (filter_var($contactEmail, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['contactEmail']);
    }

    if ($errorList) {
        // State 3: failed submission
        $app->render('postad.html.twig', array(
            'errorList' => $errorList,
            'v' => $valueList
        ));
    } else {
        // State 2: successful submission
        if ($id === '') {
            DB::insert('ad', array(
                'msg' => $message,
                'price' => $price,
                'contactEmail' => $contactEmail
            ));
            $id = DB::insertId();
            $log->debug("Ad created with ID=" . $id);
        } else {
            DB::update('ad', array(
                'msg' => $message,
                'price' => $price,
                'contactEmail' => $contactEmail
                    ), 'ID=%s', $id);
            $log->debug("Ad updated with ID=" . $id);
        }
        $app->render('postad_success.html.twig', array(
            'msg' => $message,
            'price' => $price,
            'email' => $contactEmail
        ));
    }
});

// FIRST SHOW
$app->get('/postad(/:id)', function($id = '') use ($app) {
    if ($id === '') {
        $app->render('postad.html.twig');
        return;
    }
    $ad = DB::queryOneRow("SELECT * FROM ad WHERE ID=%d", $id);
    if (!$ad) {
        $app->render("editad_notfound.html.twig");
    } else {
        $app->render("postad.html.twig", array("v" => $ad));
    }
});




////Edit Ad
//$app->get('/postad/:id', function($id) use ($app) {
//    $ad = DB::queryFirstRow("SELECT * FROM ad WHERE ID=%s", $id);
//    $app->render('postad.html.twig', array('v'=>$ad));
//})->conditions(array('id' => '\d+'));


$app->run();
