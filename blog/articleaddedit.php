<?php

/*
 * / heredoc
 * /articleaddedit.php
TODO: add 3-state form with Subject, Body (textarea)
    Require subject at least 4 characters long,
    Require body at least 50 characters long.
    Make sure you re-display subject and body if submission has failed.
    On successful submission add article to database.
 */

function getForm($subj = '', $bdy = '') {

    $f = <<< JAMISSWEET
<h3>Add or Edit Car</h3>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<form method="post">
    Subject: <input type="text" name="subject" value="$subj"><br>
    Body: <textarea name="body" value="$bdy"></textarea><br>
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

if (!isset($_POST['subject'])) {
    echo getForm();
} else {
    // Receiving a submission
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    //
    $errorList = array();
    if (empty($subject) || strlen($subject) < 4) {
        array_push($errorList, "Subject must be at least 4 characters long");
    }
    if (empty($body) || strlen($body) < 50) {
        array_push($errorList, "Body must be at least 4 characters long");
    }
    if (empty($_GET['image'])) {
        array_push($errorList, "Please upload an image for your article");
    } else {
        $file_name = $_GET['image'];
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
        echo getForm($subject, $body);
    } else {
        // STATE 2: submission successful
        $sql = sprintf("INSERT INTO articles VALUES (NULL, '%s', '%s', '%s', '%s', '%s')",
                mysqli_escape_string($conn, $_SESSION['user']['ID']),
                date('Y-m-d H:i:s'),
                mysqli_escape_string($conn, $subject),
                mysqli_escape_string($conn, $body),
                mysqli_escape_string($conn, $file_name));
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [ $sql ] : " . mysqli_error($conn));
        }
        echo "<h3>Submission successful</h3><br><br>";
        echo '<a href="articleaddedit.php">Click to continue adding another article</a>  ';
        echo '  <a href="index.php">Back to Home</a>';
    }
}

