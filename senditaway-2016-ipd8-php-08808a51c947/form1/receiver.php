<?php

$db_user = "ipd8people";
$db_name = "ipd8people";
$db_pass = "j2LrMapxxGdMJZF2";

$conn = mysqli_connect('localhost', $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}

if (!isset($_GET['name']) || !isset($_GET['age'])) {
    echo "Error: name and age must be provided";
} else {
    $name = $_GET['name'];
    $age = $_GET['age'];

    echo "Age is integer: " . is_int($age) . "<br>\n";

    if (empty($name)) {
        echo "Error: name must not be empty";
        exit;
    }
    if (empty($age)) {
        echo "Error: age must not be empty";
        exit;
    }
    echo "Hello $name! You are $age years old.";

    // PREVENTING SQL INJECTION (STEALING AND INJECTING DATA)
    // DO NOT GET FIRED OVER FORGETTING TO ESCAPE STRING !!!    
    $sql = sprintf("INSERT INTO person VALUES (NULL, '%s', '%s')",            
            mysqli_escape_string($conn, $name),
            mysqli_escape_string($conn, $age));
    
    // ALTERNATIVE - DOES THE SAME THING
    $sql = "INSERT INTO person VALUES (NULL, '" .
            mysqli_escape_string($conn, $name) . "', '" .
            mysqli_escape_string($conn, $age) . "')";

    echo "SQL QUERY IS : " . $sql . "</br>\n";
    
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error executing query [ $sql ] : " . mysqli_error($conn);
        exit;
    }
}
