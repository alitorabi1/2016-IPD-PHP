<html>
<head>
<meta charset="UTF-8">
<title>PHP - Home work #1</title>
<style>
    .contact_form input:focus:invalid, .contact_form textarea:focus:invalid { /* when a field is considered invalid by the browser */
        box-shadow: 0 0 5px #d45252;
        border-color: #b03535
    }
    .contact_form input:required:valid, .contact_form textarea:required:valid { /* when a field is considered valid by the browser */
        box-shadow: 0 0 5px #5cd053;
        border-color: #28921f;
    }
</style>
</head>
<body>
<?php

//heredoc

function getForm($desc = '', $dd = '', $isd = '') {

    $f = <<< ENDTAG
<h3>Edit Item</h3>
<form method="post" class="contact_form">
    Description: <textarea name="description" value="$desc"></textarea><br>
    Due date: <input type="text" name="dueDate" value="$dd"><br>
    Is done: <input type="number" name="isDone" value="$isd"><br>
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

if (!isset($_POST['description'])) {
    echo getForm();
} else {
    // Receiving a submission
    $description = $_POST['description'];
    $dueDate = $_POST['dueDate'];
    $isDone = $_POST['isDone'];
    //
    $errorList = array();
    if (strlen($description) < 4) {
        array_push($errorList, "Description must be at least 4 characters long");
    }
//    if (($yop < 1901) || ($yop > 2020)) {
//        array_push($errorList, "Year of production must be from 1901 to 2020");
//    }
//    if (!preg_match('/^[A-Z0-9]{3,8}$/', $plates)) {
//        array_push($errorList, "Plates must be <3-8> characters long, composed of uppercase letters and numbers");
//    }
    // 
    if (empty($dueDate)) {
        array_push($errorList, "Year of production must not be empty");
    }
    if ($errorList) { // nonempty array is considered true
        // STATE3: Submission failed - Problem found
        echo "<h5> Problems found in your submission</h5>\n";
        echo "<ul>\n";
        foreach ($errorList as $error) {
            echo "<li>\n" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>\n";
//        echo getForm($description, $dueDate, 0);
    } else {
        // STATE3: Submission successful
                $sql = "SELECT * FROM hw1todo WHERE ID=$id";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Error executing query [ $query ] : " . mysqli_error($conn));
                }

                $datarows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($datarows as $row) {
                    $desc = htmlentities($row['description']);
                    $dueDate = htmlentities($row['dueDate']);
                    echo getForm($desc, $dueDate, 0);
                }
        
        
//        $sql = "UPDATE hw1todo SET ID=NULL, description=$description, dueDate=$dueDate, isDone=0 WHERE ID=$id)";
//        $result = mysqli_query($conn, $sql);
//        if (!$result) {
//            echo "Error executing query [ $sql ] : " . mysqli_error($conn);
//        }
//        echo "Update successful";
//        echo "<form action=\"index.php\" method=\"post\">";
//        echo "<input type=\"submit\" value=\" Save \">";
//        echo "</form>";
    }
}
?>
</body>
</html>