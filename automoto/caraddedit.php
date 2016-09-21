<?php

//heredoc

function getForm($mm = '', $yy = '', $pp = '') {

    $f = <<< ENDTAG
<h3>Add or Edit Car</h3>
<form method="post" >
    Make and model: <input type="text" name="makeModel" value="$mm"><br>
    Year of product: <input type="number" name="yop" value="$yy"><br>
    Plates: <input type="text" name="plates" value="$pp"><br>
    <input type="submit" value=" Save ">
</form>
ENDTAG;
    return $f;
}

require_once 'db.php';

/* TRI-STATE Form
 * 
 * 1- First show
 * 2- Submition successful
 * 3- Submition failed (Show error list and form again)
 */

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
        array_push($errorList, "Plates must be <3-8> characters long, composed of uppercase letters and numbers");
    }
    // 
//    if (count($errorList) > 0) {
    if ($errorList) { // nonempty array is considered true
        // STATE3: Submission failed - Problem found
        echo "<h5> Problems found in your submission</h5>\n";
        echo "<ul>\n";
        foreach ($errorList as $error) {
            echo "<li>\n" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>\n";
        echo getForm($makeModel, $yop, $plates);
    } else {
        // STATE3: Submission successful
        $sql = "INSERT INTO car VALUES (NULL, '" .
                mysqli_escape_string($conn, $makeModel) . "', '" .
                mysqli_escape_string($conn, $yop) . "', '" .
                mysqli_escape_string($conn, $plates) . "')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error executing query [ $sql ] : " . mysqli_error($conn);
        }
        echo "Submission successful";
    }
}
