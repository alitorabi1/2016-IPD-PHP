<?php

function getForm($mm = '', $yy = '', $pp = '') {

    $f = <<< JAMISSWEET
<h3>Adding student</h3>
<form method="post">
    <table border="0">
    <tr><td>Name: </td><td><input type="text" name="name" value="$mm"></td></tr>
    <tr><td>Age: </td><td><input type="number" name="age" value="$yy"></td></tr>
    <tr><td>GPA: </td><td><input type="number" name="gpa" step="0.01" value="$pp"></td></tr>
    <tr><td colspan="2"><input type="checkbox" name="hasGraduated">Has graduated</td></tr>
    </table><br/>
    <input type="submit" value=" Add ">
</form>
JAMISSWEET;

    return $f;
}

require_once 'db.php';

if (isset($_POST['hasGraduated'])) {
    $hasGraduated = 'yes';
} else {
    $hasGraduated = 'no';
}
if (!isset($_POST['name'])) {
    echo getForm();
} else {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gpa = $_POST['gpa'];
    //
    $errorList = array();
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long");
    }
    if (($age < 1) || ($age > 150)) {
        array_push($errorList, "Age must be from 1 to 150");
    }
    if (($gpa < 0) || ($gpa > 4.3)) {
        array_push($errorList, "GPA must be from 0 to 4.3");
    }
    //
    if ($errorList) {
        echo "<h5>Problems found in your submission</h5>\n";
        echo "<ul>\n";
        foreach ($errorList as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>\n";
        echo getForm($name, $age, $gpa);
    } else {
        $sql = sprintf("INSERT INTO student VALUES (NULL, '%s', '%s', '%s', '%s')",
                mysqli_escape_string($conn, $name),
                mysqli_escape_string($conn, $age),
                mysqli_escape_string($conn, $gpa),
                mysqli_escape_string($conn, $hasGraduated));
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [ $sql ] : " . mysqli_error($conn));
        }
        echo "Submission successful";
    }
}