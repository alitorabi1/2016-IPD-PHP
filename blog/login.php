<?php
// Create login form with email, password, submit inputs.
// Verify user login with database, fetch record by email alone.
// Important!!!: Verify password in PHP (!), not in SQL query.

require_once 'db.php';

function getLoginForm() {
    return <<< ENDTAG
<h1>Login page</h1>
<form method="post">
    Email: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Register">
</form>
ENDTAG;
}
        
        if (!isset($_POST['email'])) {
            // STATE 1: First show
            echo getLoginForm();
        } else {
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $sql = sprintf("SELECT * FROM users WHERE email='%s'", mysqli_escape_string($conn, $email));
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error executing query [ $sql ] : " . mysqli_error($conn));
            }
            if (mysqli_num_rows($result) == 0) {
                echo "Login failed";
                echo getLoginForm();
            }
            else {
                $row = mysqli_fetch_assoc($result);
                if ($row['password'] == $pass) {
                    echo '<p>Login successful. <a href="index.php">Click to continue</a></p>';
//                    $_SESSION['userID'] = $row['ID'];
//                    $_SESSION['userName'] = $row['name'];
//                    $_SESSION['userEmail'] = $row['email'];
                    unset($row['password']);
                    $_SESSION['user'] = $row;
                    echo "<h1>Login successful.</h1>";
                    echo '<a href="index.php">Click to continue</a>';
                } else {
                    echo "Login failed";
                    echo getLoginForm();
                }
                    
            }

            $errorList = array();
        if ($errorList) {
        // STATE 3: submission failed        
        echo "<ul>\n";
        foreach ($errorList as $error) {
            echo "<li>" . htmlspecialchars($error);
        }
        echo "</ul>\n\n";
        } else {
            
        }
        }
        //

        ?>

