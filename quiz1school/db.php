<?php

$db_name = 'quiz1school';
$db_user = 'quiz1school';
$db_pass = 'KjBehP8zJBB2zBAz';

$conn = mysqli_connect('localhost', $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
