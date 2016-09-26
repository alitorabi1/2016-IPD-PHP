<html>
    <head>
        <style>
            div {
                padding: 5px;
                text-align: right;
                background-color: red;
                color: white;
            }
        </style>
        <?php
        require_once 'db.php';
        if (isset($_SESSION['user'])) {
            echo "<div>Welcome " . $_SESSION['user']['name'] . "!";
            echo 'You may <a href="logout.php">Logout</a> or <a href="articleaddedit.php">Post an article</a></div>';
        } else {
            echo "<div>You are not logged in.";
            echo '<a href="login.php">Login</a> or <a href="register.php">Register</a>.</div>';
        }
        ?>
    <H1>List of five latest articles</H1>
    <table border="1">
        <tr><th>Title</th><th>Author</th><th>Date of creation</th><th>Operation</th></tr>
        <?php
        $sql = "SELECT articles.ID as articleID, name, authorID, pubDate, title, body FROM articles, "
                . " users where articles.authorID = users.ID ORDER BY articles.ID desc LIMIT 5";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error executing query [ $sql ] : " . mysqli_error($conn);
            exit;
        }
        $dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        /*
          echo "<pre>\n";
          print_r($dataRows);
          echo "</pre>\n\n";
         */
        foreach ($dataRows as $row) {
            $ID = $row['articleID'];
            $authorID = $row['authorID'];
            $author = $row['name'];
            $title = htmlentities($row['title']);
            $pubDate = htmlentities($row['pubDate']);
            echo "<tr><td><a href=\"articleview.php?id=$ID\">$title</a></td><td><a href=\"articleview.php?id=$ID\">$author</a></td><td><a href=\"articleview.php?id=$ID\">$pubDate</a></td>\n";

            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']['ID'] === $authorID) {
                    echo "<td><a href=\"articleaddedit.php?id=$ID\">edit</a></td>\n";
                } else {
                   echo "<td> - </td>\n";
                }
            } else {
                echo "<td> - </td>\n";
            }

            echo "</tr>\n";
        }
        ?>
    </table>
</body>
</html>
