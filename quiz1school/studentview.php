<?php
//echo "<pre>\n";
//print_r($_POST);
//echo "</pre>\n\n";

function getForm($iii, $mm, $yy = '', $pp = '', $hh = '') {
    $f = <<< ENDTAG
    Student ID: $iii<br>
    Name: $mm<br>
    Age: $yy<br>
    GPA: $pp<br>
    Has graduated: $hh
ENDTAG;
    return $f;
}

if (!isset($_GET['name'])) {
    $id = $_GET['id'];
    require_once 'db.php';
    $sql = sprintf("SELECT * FROM student WHERE ID='%d'", mysqli_escape_string($conn, $id));
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing query [ $sql ] : " . mysqli_error($conn));
    }
    $dataRows = mysqli_fetch_assoc($result);
    if ($dataRows === null) {
        echo "Error: Please select a valid student";
        return;
    }
    $ID = $dataRows['ID'];
    $name = htmlspecialchars($dataRows['name']);
    $age = htmlspecialchars($dataRows['age']);
    $gpa = htmlspecialchars($dataRows['gpa']);
    $hasGraduated = htmlspecialchars($dataRows['hasGraduated']);
    echo getForm($ID, $name, $age, $gpa, $hasGraduated);
} else {
    echo "Error: Please select a valid student";
}