<?php

session_start();

// enable on-demand class loader
require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'slimshop';
DB::$user = 'slimshop';
//DB::$password = "BJZSdfS92F4  fB2en";
DB::$password = "hdpuJCL668ADQbnM";
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

/*
  \Slim\Route::setDefaultConditions(array(
  'id' => '\d+'
  )); */

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}

$twig = $app->view()->getEnvironment();
$twig->addGlobal('sessionUser', $_SESSION['user']);

$app->get('/', function() use ($app) {
    $productList = DB::query("SELECT * FROM products");
    $app->render('index.html.twig', array(
        'sessionUser' => $_SESSION['user'],
        'productList' => $productList
    ));
});

$app->get('/cart', function() use ($app) {
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

$app->post('/cart', function() use ($app) {
    $productID = $app->request()->post('productID');
    $quantity = $app->request()->post('quantity');
    // FIXME: make sure the item is not in the cart yet
    $item = DB::queryFirstRow("SELECT * FROM cartitems WHERE productID=%d AND sessionID=%s", $productID, session_id());
    if ($item) {
        DB::update('cartitems', array(
            'sessionID' => session_id(),
            'productID' => $productID,
            'quantity' => $item['quantity'] + $quantity
                ), "productID=%d AND sessionID=%s", $productID, session_id());
    } else {
        DB::insert('cartitems', array(
            'sessionID' => session_id(),
            'productID' => $productID,
            'quantity' => $quantity
        ));
    }
    // show current contents of the cart
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

// AJAX call, not used directy by user
$app->get('/cart/update/:cartitemID/:quantity', function($cartitemID, $quantity) use ($app) {
    if ($quantity == 0) {
        DB::delete('cartitems', 'cartitems.ID=%d AND cartitems.sessionID=%s', $cartitemID, session_id());
    } else {
        DB::update('cartitems', array('quantity' => $quantity), 'cartitems.ID=%d AND cartitems.sessionID=%s', $cartitemID, session_id());
    }
    echo json_encode(DB::affectedRows() == 1);
});

// order handling
$app->map('/order', function () use ($app) {
    $totalBeforeTax = DB::queryFirstField(
             "SELECT SUM(products.price * cartitems.quantity) "
            ." FROM cartitems, products "
            ." WHERE cartitems.sessionID=%s AND cartitems.productID=products.ID",
            session_id());
    // TODO: properly compute taxes, shipping, ...
    $shippingBeforeTax = 15.00;
    $taxes = ($totalBeforeTax + $shippingBeforeTax) * 0.15;
    $totalWithShippingAndTaxes = $totalBeforeTax + $shippingBeforeTax + $taxes;
    
    if ($app->request->isGet()) {
        $app->render('order.html.twig', array(
            'totalBeforeTax' => number_format($totalBeforeTax, 2),
            'shippingBeforeTax' => number_format($shippingBeforeTax, 2),
            'taxes' => number_format($taxes, 2),
            'totalWithShippingAndTaxes' => number_format($totalWithShippingAndTaxes, 2)
        ));
    } else {
        $name = $app->request->post('name');
        $email = $app->request->post('email');
        $address = $app->request->post('address');
        $postalCode = $app->request->post('postalCode');
        $phoneNumber = $app->request->post('phoneNumber');
        $valueList = array(
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'postalCode' => $postalCode,
            'phoneNumber' => $phoneNumber
            );
        // FIXME: verify inputs - MUST DO IT IN A REAL SYSTEM
        $errorList = array();
        //
        if ($errorList) {
            $app->render('order.html.twig', array(
                'totalBeforeTax' => number_format($totalBeforeTax, 2),
                'shippingBeforeTax' => number_format($shippingBeforeTax, 2),
                'taxes' => number_format($taxes, 2),
                'totalWithShippingAndTaxes' => number_format($totalWithShippingAndTaxes, 2),
                'v' => $valueList
            ));
        } else { // successful submissions
            // PLACE THE ORDER
            DB::$error_handler = FALSE;
            DB::$throw_exception_on_error = TRUE;
            try {
                DB::startTransaction();
                
                DB::commit();
            } catch (MeekroDBException $ex) {
                DB::rollback();
                sql_error_handler(array('error' => $ex->getMessage(), 'query' => $ex->getQuery()));
            }
        }
    }
})->via('GET', 'POST');

// Password reset
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$app->map('/passreset', function() use ($app, $log) {
    if ($app->request->isGet()) {
        $app->render('passreset.html.twig');
    }else {
        $email = $app->request()->post('email');
        $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
        if ($user) {
            $app->render('passreset_success.html.twig');
            DB::insert();
        } else {
            $app->render('passreset.html.twig', array('error' => TRUE));
        }
    }
    
})->via('GET', 'POST');

$app->post('/order', function() use ($app) {
    
});

// ADMIN - CRUD for products table

$app->get('/admin/products/list', function() use ($app) {
    echo "TODO: display product list and add new link";
});

$app->get('/admin/products/addedit(/:productID)', function() use ($app) {
    echo "TODO: form to add new product";
});

$app->post('/admin/products/addedit(/:productID)', function() use ($app) {
    echo "TODO: form to add new product - received submission";
});

$app->get('/admin/products/delete/:productID', function() use ($app) {
    echo "TODO: form to ask for conformation to delete a product";
});

$app->post('/admin/products/delete/:productID', function() use ($app) {
    echo "TODO: confirmation of deletion received";
});




/*
  // ALTERNATIVE: provide product/quantitiy in URL
  $app->get('/cart/add/:productID/:quantity', function() use ($app) {
  }); */


$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if ($user) {
        echo "Email already registered";
    }
});

// State 1: first show
$app->get('/register', function() use ($app, $log) {
    $app->render('register.html.twig');
});
// State 2: submission
$app->post('/register', function() use ($app, $log) {
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $valueList = array('name' => $name, 'email' => $email);
    // submission received - verify
    $errorList = array();
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long");
        unset($valueList['name']);
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    } else {
        $user = DB::queryFirstRow("SELECT ID FROM users WHERE email=%s", $email);
        if ($user) {
            array_push($errorList, "Email already registered");
            unset($valueList['email']);
        }
    }
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        array_push($errorList, "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character");
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }
    //
    if ($errorList) {
        // STATE 3: submission failed        
        $app->render('register.html.twig', array(
            'errorList' => $errorList, 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        DB::insert('users', array(
            'name' => $name, 'email' => $email,
            'password' => password_hash($pass1, CRYPT_BLOWFISH)
                // 'password' => hash('sha256', $pass1)
        ));
        $id = DB::insertId();
        $log->debug(sprintf("User %s created", $id));
        $app->render('register_success.html.twig');
    }
});

// State 1: first show
$app->get('/login', function() use ($app, $log) {
    $app->render('login.html.twig');
});
// State 2: submission
$app->post('/login', function() use ($app, $log) {
    $email = $app->request->post('email');
    $pass = $app->request->post('pass');
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if (!$user) {
        $log->debug(sprintf("User failed for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        //if ($user['password'] == hash('sha256', $pass)) {
        if (password_verify($pass, $user['password'])) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['user'] = $user;
            $log->debug(sprintf("User %s logged in successfuly from IP %s", $user['ID'], $_SERVER['REMOTE_ADDR']));
            $app->render('login_success.html.twig');
        } else {
            $log->debug(sprintf("User failed for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));
        }
    }
});

$app->get('/logout', function() use ($app, $log) {
    $_SESSION['user'] = array();
    $app->render('logout_success.html.twig');
});

$app->run();
