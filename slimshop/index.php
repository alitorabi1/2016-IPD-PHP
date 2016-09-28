<?php

session_start();
require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));


DB::$dbName = 'slimshop';
DB::$user = 'slimshop';
DB::$password = "hdpuJCL668ADQbnM";
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
    echo "Welcome to slimstore Page";
    $adList = DB::query('SELECT * FROM users');
    $app->render('index.html.twig', array('adList' => $adList));
});

$app->get('/register', function() use ($app){
    $app->render('register.html.twig');
});

$app->post('/register', function() use ($app, $log){
//    echo 'Not implemented yet.';
    $name = $app->request->post('email');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $valueList = array('name' => $name, 'email' => $email, 'pass1' => $pass1);
    $errorList = array();
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long");
        unset($valueList['name']);
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    }

    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        array_push($errorList, "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character");
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }

    if ($errorList) {
        $app->render('register.html.twig', array('errorList' => $errorList, 'v' => $valueList));
    } else {
        DB::insert('users', array('name' => $name, 'email' => $email, 'password' => $pass1));
        $id = DB::insertId();
        $log->debug("User created with ID=" . $id);
        $app->render('register_success.html.twig', array('name' => $name, 'email' => $email, 'pass1' => $pass1));
    }
});

$app->get('/login', function() use ($app){
    $app->render('register.html.twig');
});

$app->post('/login', function() use ($app, $log){
//    echo 'Not implemented yet.';
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $valueList = array('email' => $email, 'pass1' => $pass1);
    $errorList = array();
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    }

    if ($errorList) {
        $app->render('register.html.twig', array('errorList' => $errorList, 'v' => $valueList));
    } else {
        $user = DB::query("SELECT * FROM users WHERE email='%s'", $email);
        if ($user == 0) {
            $app->render('login_failed.html.twig');
        } else {
            $app->render('login_successful.html.twig');
        }
    }
});

//$app->get('/postad(/:id)', function($id = '') use ($app, $log){
//    if ($id === '') {
//        $app->render('postad.html.twig');
//        return;
//    }
//    $ad = DB::queryOneRow("SELECT * FROM ad WHERE ID=%d", $id);
//    if (!$id) {
//        $app->render('editad_notfound.html.twig', array('msg' => $msg, 'price' => $price, 'contactEmail' => $contactEmail));
//    } else {
//        $app->render('postad.html.twig', array('v' => $ad));
//    }
//});

//$app->post('/editad/:id', function($id) use ($app){});

$app->run();
