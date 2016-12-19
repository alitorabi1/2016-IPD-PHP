<?php

require_once 'db.php';

$sql = "SELECT * FROM person";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error executing query [ $sql ] : " . mysqli_error($conn);
    exit;
}

$numrows = mysqli_num_rows($result);

echo "<p>Number rows fetched: $numrows</p>\n";

$dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// print_r($dataRows);

echo "<table border=1>\n";
echo "<tr><th>#</th><th>name</th><th>age</th></tr>\n";

foreach ($dataRows as $row) {
    // TODO: htmlentities() or htmlspecialchars() [PREFERRED]
    $ID = $row['ID'];
    $name = htmlspecialchars($row['name']);
    $age = $row['age'];
    echo "<tr><td>$ID</td><td>$name</td><td>$age</td></tr>\n";
}

echo "</table>\n\n";


