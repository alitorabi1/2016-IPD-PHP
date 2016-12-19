<?php

// heredoc

function getForm($mm = '', $yy = '', $pp = '') {

    $f = <<< JAMISSWEET
<h3>Add or Edit Car</h3>
<form method="post">
    Make and model: <input type="text" name="makeModel" value="$mm"><br>
    Year of production: <input type="number" name="yop" value="$yy"><br>
    Plates: <input type="text" name="plates" value="$pp"><br>
    Is done? <input type="checkbox" name="isDone"><br>
    <input type="submit" value="Save">
</form>
JAMISSWEET;

    return $f;
}

require_once 'db.php';

/* TRI-STATE FORM
 * 1. First show 
 * 2. Submission Successful
 * 3. (show error list and form again)
 */

// For debugging purposes only - view all submitted values
echo "<pre>\n";
print_r($_POST);
echo "</pre>\n\n";

if (!isset($_POST['makeModel'])) {
    echo getForm();
} else {
    // Receiving a submission
    $makeModel = $_POST['makeModel'];
    $yop = $_POST['yop'];
    $plates = $_POST['plates'];
    //
    $errorList = array();
    if (strlen($makeModel) < 4) {
        array_push($errorList, "Make model must be at least 4 characters long");
    }
    if (($yop < 1901) || ($yop > 2020)) {
        array_push($errorList, "Year of production must be from 1901 to 2020");
    }
    if (!preg_match('/^[A-Z0-9]{3,8}$/', $plates)) {
        array_push($errorList, "Plates must be <3-8> characters long, " .
                "composed of uppercase letters and numbers");
    }
    //
    if ($errorList) {
        // STATE 3: submission failed - problems found
        echo "<h5>Problems found in your submission</h5>\n";
        echo "<ul>\n";
        foreach ($errorList as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>\n";
        echo getForm($makeModel, $yop, $plates);
    } else {
        // STATE 2: submission successful
        $sql = sprintf("INSERT INTO car VALUES (NULL, '%s', '%s', '%s')",
                mysqli_escape_string($conn, $makeModel),
                mysqli_escape_string($conn, $yop),
                mysqli_escape_string($conn, $plates));
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [ $sql ] : " . mysqli_error($conn));
        }
        echo "Submission successful";
    }
}

