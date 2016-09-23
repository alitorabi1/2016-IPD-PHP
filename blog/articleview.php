<?php

require_once 'db.php';

if (!isset($_SESSION['user'])) {
    echo '<h1>Access forbidden</h1>';
    echo 'Only logged in users are allowed to post.';
    echo '<a href="index.php">Click to continue</.a>';
    exit;
}

/* TODO: add form with subject and body (textarea)
  articleview.php?id=7

  TODO: Add code to fetch the one article from database
  and display it in full (Title, Author name, Date of creation, body).
 */

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = sprintf("SELECT a.title as T, u.name as N, a.pubDate as PD, a.body as B FROM articles a, users u WHERE a.ID='%d'" .
            "AND u.name=(SELECT name FROM users where ID=a.authorID)", mysqli_escape_string($conn, $id));
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing query [ $sql ] : " . mysqli_error($conn));
    }
    $datarows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($datarows as $row) {
        $title = htmlentities($row['T']);
        $author = htmlentities($row['N']);
        $pubDate = htmlentities($row['PD']);
        $body = htmlentities($row['B']);
    }
    echo "<h2>View details of the article: $id </h2>";
    echo "Title: $title <br>";
    echo "Author name: $author <br>";
    echo "Date of creation: $pubDate<br>";
    echo "Body: $body <br><br>";
    echo '<a href="index.php">Back to Home</a>';
} else {
    echo "Error: Please select a valid student";
}
