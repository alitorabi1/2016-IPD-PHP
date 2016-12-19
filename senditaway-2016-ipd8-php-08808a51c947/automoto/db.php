<?php

$db_name = 'ipd8automoto';
$db_user = 'ipd8automoto';
$db_pass = 'jz8rc6LWPBuws89p';

$conn = mysqli_connect('localhost', $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
