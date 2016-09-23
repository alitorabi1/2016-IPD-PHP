<html>
    <head>
        <style>
            div {
                text-align: right;
                background-color: red;
                color: white;
            }
        </style>
<?php
require_once 'db.php';

if (isset($_SESSION['user'])) {
    echo '<div>';
    echo "Welcome " . $_SESSION['user']['name'] . "!";
    echo 'You may  <a href="logout.php">Log out</a> ' .
         'or <a href="articleaddedit.php">Post an article</a>.';
    echo '</div>';
//        TODO: Add code to fetch the latest 5 articles from database
//        and display their titles, author and date of creation.
    ?>
        <H1>List of five latest articles</H1>
        <table border="1">
        <tr><th>Title</th><th>Author</th><th>Date of creation</th></tr>
            <?php
            $query = "SELECT * FROM articles ORDER BY ID DESC";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Error executing query [ $query ] : " . mysqli_error($conn));
            }
                $datarows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($datarows as $row) {
                    $counter = 1;
                    if ($counter == 5) break;
                    $ID = $row['ID'];
                    $title = htmlentities($row['title']);
                    $author = htmlentities($row['authorID']);
                    $pubDate = htmlentities($row['pubDate']);
                    $counter++;
                    
                    echo "<tr><td><a href=\"articleview.php?id=$ID\">$title</a></td><td><a href=\"articleview.php?id=$ID\">$author</a></td><td><a href=\"articleview.php?id=$ID\">$pubDate</a></td>\n";
                    echo "</tr>\n";
                }
            ?>
        </table>
  
<?php
} else {
    echo "You are not logged in.";
    echo '<a href="login.php">Login</a> or <a href="register.php">Register</a>.';
}
?>