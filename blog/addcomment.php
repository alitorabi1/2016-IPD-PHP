<?php
require_once 'db.php';

$target_dir = "uploads/";
$max_file_size = 5 * 1024 * 1024; // 5000000
// Only authenticated users are allowed to post a new article
if (!isset($_SESSION['user'])) {
    echo '<h1>Access forbidden</h1>';
    echo '<p>Only logged in users are allowed to post.</p>';
    echo '<a href="index.php">Click to continue</a>';
    exit;
}

function getForm($subj = '', $bb = '') {
    $form = <<< ENDTAG
    <form method="POST" enctype="multipart/form-data">
    Picture: <input type="file" name="picFile"><br><br>
    Subject: <input type="text" name="subject" value="$subj"><br><br>
    Body: <textarea  rows="20" cols="50" name="body" value="$bb"></textarea><br><br>
    <input type ="submit" value="Add Article"> 
</form>  
ENDTAG;
    return $form;
}

if (!isset($_POST['body'])) {
    //First Show if no data is provided
    echo getForm();
} else {
    //Receiving a submission
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    //Validate input 
    $errorList = array();
    //Check if name is at least 4 characters long
    if (strlen($subject) < 4) {
        array_push($errorList, "Subject must be at least 4 characters long");
    }
    if (strlen($body) < 50) {
        array_push($errorList, "Body must be at least 50 characters long");
    }
    if (!isset($_FILES['picFile'])) {
        // not receiving an upload of file - error!
        array_push($errorList, "You must select a picture for upload");
    } else {
        $fileUpload = $_FILES['picFile'];

        $check = getimagesize($fileUpload["tmp_name"]);
        if (!$check) {
            array_push($errorList, "File upload was not an image file.");
        } elseif (!in_array($check['mime'], array('image/png', 'image/gif', 'image/bmp', 'image/jpeg'))) {
            array_push($errorList, "Error: Only accepting valie png,gif,bmp,jpg files.");
        } elseif ($fileUpload['size'] > $max_file_size) {
            array_push($errorList, "Error: File to big, maximuma accepted is $max_file_size bytes");
        }
    }

    //Display error messages if invalid data is submitted
    if ($errorList) {
        //submission failed
        echo "<h5>Problems  found in your submission</h5>\n";
        echo "</ul>\n";
        foreach ($errorList as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul><br><br><br><hr>";
        echo getForm($subject, $body);
    } else {
        //submition succesfull
        $file_name = preg_replace('/[^A-Za-z0-9\-]/', '_', $fileUpload['name']);
        $file_extension = explode('/', $check['mime'])[1];
        $target_file = $target_dir . date("Ymd-His-") . $file_name . '.' . $file_extension;
        // echo "file will be named: " . $target_file;
        if (move_uploaded_file($fileUpload["tmp_name"], $target_file)) {
            echo "The file " . basename($fileUpload["name"]) . " has been uploaded.";
        } else {
            die("Fatal error: There was an server-side error handling the upload of your file.");
        }
        //
        $sql = sprintf("INSERT INTO articles VALUES (NULL, '%s', '%s', '%s', '%s', '%s')",
                mysqli_escape_string($conn, $_SESSION['user']['ID']),
                mysqli_escape_string($conn, date("Y-m-d")),
                mysqli_escape_string($conn, $subject),
                mysqli_escape_string($conn, $body),
                mysqli_escape_string($conn, $target_file));
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error executing query [$sql] : " . mysqli_error($conn);
        } else {
            echo "The article was posted succesfully<br><br>\n";
            echo "<a href=\"index.php\">Go to home page</a>";
        }
    }
}
