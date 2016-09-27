<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'db.php';
        if (isset($_SESSION['user'])) {
//        echo "<pre>\n";
//        print_r($_SESSION['user']);
//        echo "</pre>\n\n";
            $id = $_SESSION['user']['ID'];
            echo "Welcome " . $_SESSION['user']['email'] . "!";
            echo ' You may <a href="logout.php">Logout</a>';
        } else {
            echo "You are not logged in. Please ";
            echo '<a href="login.php">Login</a> or <a href="register.php">Register</a>.';
            exit;
        }


        $sql = "SELECT pictures.ID as pictureID, description, picturePath FROM pictures, "
                . " users where pictures.ownerID = users.ID and users.ID=$id";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error executing query [ $sql ] : " . mysqli_error($conn);
            exit;
        }
        $dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo "<H1>List of your pictures</H1>";
            echo '<a href="addpic.php">Add a picture</a>';
        if (count($dataRows) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>#</th><th>Description</th><th>picture</th></tr>";
            foreach ($dataRows as $row) {
                $ID = $row['pictureID'];
                $description = $row['description'];
                $picturePath = htmlspecialchars($row['picturePath']);
                echo "<tr><td>$ID</td><td>$description</a></td><td><a href=\"$picturePath\"><img src=\"$picturePath\" width='150px'></a></td>\n";
                echo "</tr>\n";
            }
        }
        ?>
    </table>
</body>
</html>
