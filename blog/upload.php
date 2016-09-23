<?php

$target_dir = "uploads/";
$max_file_size = 5 * 1024 * 1024; // 5000000

echo "<pre>\n";
echo "\$_FILES:\n";
print_r($_FILES);

if (!isset($_POST['submit'])) {
    die("Error: File upload expected.");
}
$fileUpload = $_FILES['fileToUpload'];

$check = getimagesize($fileUpload["tmp_name"]);
if (!$check) {
    die("Error: File upload was not an image file.");
}
switch ($check['mime']) {
    case 'image/png':
    case 'image/gif':
    case 'image/bmp':
    case 'image/jpeg':
        break;
    default:
        die("Error: Only accepting valie png,gif,bmp,jpg files.");
}
if ($fileUpload['size'] > $max_file_size) {
    die("Error: File to big, maximuma accepted is $max_file_size bytes");
}

// WARNING (CYA): Make sure no '..' is allowed in the path
// SOLUTION 1: use the original file name
if (strstr($fileUpload['name'], '..')) {
    die("Error: do not mess with the Zohan");
}
$target_file = $target_dir . $fileUpload['name'];

// SOLUTION 2: generate your own file name
$file_extension = explode('/', $check['mime'])[1];
$file_name = md5($fileUpload["name"] . time()) . '.' . $file_extension;
$target_file = $target_dir . $file_name;

if (move_uploaded_file($fileUpload["tmp_name"], $target_file)) {
    echo "The file " . basename($fileUpload["name"]) . " has been uploaded.";
    echo "<a href='articleaddedit.php?image=$target_file'>Click to continue</a>";
} else {
    echo "Sorry, there was an error uploading your file.";
}