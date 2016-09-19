<?php

require_once 'db.php';

$sql = "SELECT * FROM person";


$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error executing query [ $sql ] : " . mysqli_error($conn);
}

$numrows = mysqli_num_rows($result);
echo "<p>Number rows fetched: $numrows</p>\n";

$datarows = mysqli_fetch_all($result, MYSQLI_ASSOC);

//print_r($datarows);

echo "<table border = 1>";
echo "<tr><th>#</th><th>Name</th><th>Age</th></tr>";
foreach ($datarows as $row) {
    $ID = $row['ID'];
    $name = htmlentities($row['name']);
    $age = $row['age'];
    echo "<tr><td>$ID</td><td>$name</td><td>$age</td>";
}
echo "</table>";
