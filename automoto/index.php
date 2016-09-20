<html>
    <head>
        <meta charset="UTF-8">
        <title>Car database</title>
    </head>
    <body>
        <a href="caraddedit.php">Add car</a>
        <table border="1">
        <tr><th>#</th><th>Make model</th><th>YOP</th><th>Plate</th><th>operations</th></tr>
            <?php
            
            require_once 'db.php';
            
            $query = "SELECT * FROM car";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Error executing query [ $query ] : " . mysqli_error($conn));
            }
                $datarows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($datarows as $row) {
                    $ID = $row['ID'];
                    $makeModel = htmlentities($row['makeModel']);
                    $yop = $row['yop'];
                    $plates = htmlentities($row['plates']);
                    
                    echo "<tr><td>$ID</td><td>$makeModel</td><td>$yop</td><td>$plates</td>\n";
                    echo "<td><a href=\"cardelete.php?id=$ID\">Delete</td>\n";
                    echo "</tr>\n";
                }
            ?>
        </table>
    </body>
</html>
