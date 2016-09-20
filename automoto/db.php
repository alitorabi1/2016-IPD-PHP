<?php

$db_name = 'ipd8automoto';
$db_user = 'ipd8automoto';
$db_pass = 'S8Ycsp3GtYLyYj2d';

$conn = mysqli_connect('localhost', $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
