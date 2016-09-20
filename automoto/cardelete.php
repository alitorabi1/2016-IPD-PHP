<?php

function getForm($iii) {
$f = <<< ENDTAG
   <p>Are you sure you want to delete record number $iii ? </p>
        <form action="index.php">
            <input type="submit" value="Cancel">
        </form>
        
        <form action="index.php">
            <input type="hidden" name="id" value="$iii">
            <input type="hidden" name="confirmed" value="yes">
            <input type="submit" value="Delete">
        </form>
        
ENDTAG;
return $f;
}

if (!isset($_GET['confirmed'])) {
    $id = $_GET['id'];
    require_once 'db.php';
    $sql = sprintf("DELETE FROM car WHERE ID='%s'", mysqli_escape_string($conn, $id));
    $result = mysqli_query($conn, $sql);
    
    echo "<p>Record has been deleted </p>\n";
    echo "<a href=\"index.php\">Click to continue";
} else {
    // Receiving a submission
    echo getForm($_GET['id']);
}

