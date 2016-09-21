<?php

$db_user = "ipd8-ali";
$db_name = "ipd8-ali";
$db_pass = "WTSXRUAfHzMj2aZB";

$conn = mysqli_connect('localhost', $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
