<?php

session_start();
$db_user = "blog";
$db_name = "blog";
$db_pass = "p3cFUE7nM5AMXWqY";
//$db_pass = "qU4jd9DKV745nD7N";

$conn = mysqli_connect('localhost', $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
