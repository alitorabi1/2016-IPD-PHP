<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["txtDescription"])) {
        echo "Description is required";
        echo "<form action='index.php'>";
        echo "<br/><br/><input type='submit' value=' View items '>";
        echo "</form>";
        return false;
    } else {
        $desc = test_input($_POST["txtDescription"]);
    }

    if (empty($_POST["txtDueDate"])) {
        echo "Due date is required";
        echo "<form action='index.php'>";
        echo "<br/><br/><input type='submit' value=' View items '>";
        echo "</form>";
        return false;
    } else {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST["txtDueDate"])) {
            $dueDate = test_input($_POST["txtDueDate"]);
        } else {
            echo "Due date is not in the required format.";
            echo "<form action='index.php'>";
            echo "<br/><br/><input type='submit' value=' View items '>";
            echo "</form>";
            return false;
        }
    }
}
require_once 'db.php';
$sql = "INSERT INTO hw1todo VALUES (NULL, '" .
        mysqli_escape_string($conn, $desc) . "', '" .
        mysqli_escape_string($conn, $dueDate) . "', 0)";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Error executing query [ $sql ] : " . mysqli_error($conn);
    echo "<form action='index.php'>";
    echo "<br/><br/><input type='submit' value=' View items '>";
    echo "</form>";
    return false;
}
echo "<form action='index.php'>";
echo "Description: $desc and dueDate: $dueDate was added successfuly";
echo "<br/><br/><input type='submit' value=' View items '>";
echo "</form>";
?>