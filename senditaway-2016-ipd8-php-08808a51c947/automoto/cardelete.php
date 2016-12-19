<?php

function getForm($iii) {
    $f = <<< ENDTAG
        <p>Are you sure you want to delete record number $iii ?</p>
        
        <form action="index.php">
            <input type="submit" value="Cancel">
        </form>
        
        <form>
            <input type="hidden" name="id" value="$iii">
            <input type="hidden" name="confirmed" value="yes">
            <input type="submit" value="Delete">
        </form>
ENDTAG;
    return $f;
}

if (isset($_GET['confirmed'])) {
    $id = $_GET['id'];
    // TODO: delete the record and tell user it was deleted
    require_once 'db.php';
    $sql = sprintf("DELETE FROM car WHERE ID='%d'", mysqli_escape_string($conn, $id));
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing query [ $sql ] : " . mysqli_error($conn));
    }
    echo "<p>Record has been deleted</p>\n";
    echo "<a href=\"index.php\">Click to continue</a>\n";
} else {
    // FIRST SHOW
    echo getForm($_GET['id']);
}
