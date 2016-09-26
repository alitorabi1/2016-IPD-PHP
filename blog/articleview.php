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


        if (!isset($_GET['id'])) {
            die('No article to view');
        }
        echo "<h2>Article View</h2>";

        $sql = sprintf("SELECT * FROM articles, users WHERE authorID=users.ID and articles.ID= '%s'", mysqli_escape_string($conn, $_GET['id']));
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error executing query [$sql] : " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            die("No article was found");
        }
        $title = htmlspecialchars($row['title']);
        $body = htmlspecialchars($row['body']);
        $author = $row['name'];
        $pubDate = $row['pubDate'];
        $imagePath = $row['imagePath'];

        echo "<h3>$title</h3>";
        echo "<p><i>Posted by</i> $author at $pubDate</p><br>";
        echo sprintf('<img src="%s" width="250">', $imagePath);
        echo "<p>$body</p>";

//


function getForm() {
$form = <<< ENDTAG
<form method='post' action='addcomment.php'>
My comment<br>
<input type ='submit' value='Add comment'>&nbsp;&nbsp;&nbsp;
you must <a href="login.php">Login</a> or <a href="register.php">Register</a> to post comments
</form>
ENDTAG;
return $form;
}

function getFormComment($cmnt = '') {
$form = <<< ENDTAG
<form method='post'>
My comment<br>
<input type ='submit' value='Add comment'>&nbsp;&nbsp;&nbsp;
<input type ='text' size='50' name='comment' value="$cmnt">
</form>
ENDTAG;
return $form;
}

        if (!isset($_SESSION['user'])) {
            //First Show if no data is provided
            echo getForm();
        } else {
            //Receiving a submission
            if (!isset($_POST['comment'])) {
                //First Show if no data is provided
                echo getFormComment();
            } else {
                //Receiving a submission
                $comment = $_POST['comment'];
                //Validate input 
                $errorList = array();
                //Check if name is at least 4 characters long
                if (strlen($comment) < 4) {
                    array_push($errorList, "Comment must be at least 4 characters long");
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
                    echo getFormComment($comment);
                } else {
        echo "<pre>\n";
        print_r($_SESSION['user']);
        echo "</pre>\n\n";
                    //submition succesfull
                    $sql = sprintf("INSERT INTO comments VALUES (NULL, '%s', '%s', '%s', NULL)",
                            mysqli_escape_string($conn, $_GET['id']), 
                            mysqli_escape_string($conn, $_SESSION['user']['ID']), 
                            mysqli_escape_string($conn, $comment));
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        echo "Error executing query [$sql] : " . mysqli_error($conn);
                    } else {
                        echo getFormComment($comment);
//                        echo "The comment was posted succesfully<br><br>\n";
//                        echo "<a href=\"index.php\">Go to home page</a>";
                    }
                }
            }

            $sql = sprintf("SELECT * FROM comments WHERE articleID= '%s'", mysqli_escape_string($conn, $_GET['id']));
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Error executing query [$sql] : " . mysqli_error($conn));
            }
            $dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo "<ul>";
            foreach ($dataRows as $row) {
                $body = htmlspecialchars($row['body']);

                echo "<li>$body</li>";
            }
            echo "</ul>";
        }
        ?>
    </body>
</html>
