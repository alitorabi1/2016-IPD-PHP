<?php

require_once 'db.php';

//        if (isset($name) !== FALSE) {
if (!isset($_GET['name']) || !isset($_GET['age'])) {
    echo "Error: name and age are not provided!";
} else {
    $name = $_GET['name'];
    $age = $_GET['age'];
    if (empty($name)) {
        echo 'Name is empty. <br> please try again!';
        exit;
    }
    if (empty($age)) {

        echo 'Agee is empty. <br> please try again!';
        exit;
    }
    echo 'Hello ' . $name . ' you are ' . $age . ' years old';
}

$sql = "INSERT INTO person VALUES (NULL, '" .
        mysqli_escape_string($conn, $name) . "', '" .
        mysqli_escape_string($conn, $age) . "')";

echo "<br>SQL query is: " . $sql . "<br>\n";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error executing query [ $sql ] : " . mysqli_error($conn);
}
?>