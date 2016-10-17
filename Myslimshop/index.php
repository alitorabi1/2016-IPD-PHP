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
//DB::$password = "BJZSdfS92F4fB2en";
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
    $productList = DB::query("SELECT * FROM products");
    $app->render('index.html.twig', array('sessionUser' => $_SESSION['user'], 'productList' => $productList));
});

$app->get('/', function() use ($app) {
    $userList = DB::query('SELECT * FROM users');
    $app->render('index.html.twig', array('userList' => $userList));
});

$app->get('/cart', function() use ($app){
    $cartitemList = DB::query(
            "SELECT cartitems.ID as ID, productID, quantity,"
            . " name, description, imagePath, price "            
            . " FROM cartitems, products "
            . " WHERE cartitems.productID = products.ID AND sessionID=%s", session_id());
    $app->render('cart.html.twig', array(
        'sessionUser' => $_SESSION['user'],
        'cartitemList' => $cartitemList
    ));
});

$app->post('/cart', function() use ($app){
    $productID = $app->request()->post('productID');
    $quantity = $app->request()->post('quantity');
    DB::insert('cartitems', array('sessionID' => session_id(), 'productID' => $productID, 'quantity' => $quantity));
    echo "TODO: Receiving item add";
});

$app->get('/cart/update/:cartitemID/:quantity', function() use ($app){
    echo "TODO: Cart will go here";
});


// Admin
$app->get('/admin/product/list', function() use ($app){
    echo "TODO: display product list and add new link";
});

$app->get('/admin/product/add', function() use ($app){
    echo "TODO: form add a new product";
});

$app->post('/admin/product/add', function() use ($app){
    echo "TODO: form add a new product - received submission";
});

$app->get('/admin/product/delete/:productID', function() use ($app){
    echo "TODO: form to ask for confirmation to delete a product";
});

$app->post('/admin/product/delete/:productID', function() use ($app){
    echo "TODO: confirmation of deletion received";
});

$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow("SELECT ID FROM users WHERE email=%s", $email);
    if ($user) {
        echo "Email already registered";
    }
});
    
$app->get('/register', function() use ($app){
    $app->render('register.html.twig');
});

$app->post('/register', function() use ($app, $log){
//    echo 'Not implemented yet.';
    $name = $app->request->post('name');
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
        DB::insert('users', array('name' => $name, 'email' => $email, 'password' => sha256($pass1)));
        $id = DB::insertId();
        $log->debug("User created with ID=" . $id);
        $app->render('register_success.html.twig', array('name' => $name, 'email' => $email, 'pass1' => $pass1));
    }
});

$app->post('/login', function() use ($app, $log) {
    $email = $app->request->post('email');
    $pass = $app->request->post('pass');
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);    
    if (!$user) {
        $log->debug(sprintf("User failed for email %s from IP %s",
                    $email, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        if ($user['password'] == hash('sha256', $pass)) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['user'] = $user;
            $log->debug(sprintf("User %s logged in successfuly from IP %s",
                    $user['ID'], $_SERVER['REMOTE_ADDR']));
            $app->render('login_success.html.twig');
        } else {
            $log->debug(sprintf("User failed for email %s from IP %s",
                    $email, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));            
        }
    }
});

$app->get('/delete(/:id)', function($id = '') use ($app) {
    DB::delete('users', "ID=%s", $id);
    $app->render("delete.html.twig");
});


$app->get('/logout', function() use ($app){
    unset($_SESSION['user']);
    $app->render('logout.html.twig');
});

$app->run();
