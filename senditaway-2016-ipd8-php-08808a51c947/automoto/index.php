<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Car database</title>
    </head>
    <body>
        <a href="caraddedit.php">Add car</a>
        <table border="1">
            <tr><th>#</th><th>make model</th><th>yop</th><th>plates</th><th>operations</th></tr>
            <?php
            require_once 'db.php';

            $sql = "SELECT * FROM car";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error executing query [ $sql ] : " . mysqli_error($conn));
            }
            $dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($dataRows as $row) {
                // TODO: htmlentities() or htmlspecialchars() [PREFERRED]
                $ID = $row['ID'];
                $makeModel = htmlspecialchars($row['makeModel']);
                $yop = $row['yop'];
                $plates = htmlspecialchars($row['plates']);
                echo "<tr><td>$ID</td><td>$makeModel</td><td>$yop</td><td>$plates</td>\n";
                echo "<td><a href=\"cardelete.php?id=$ID\">Delete</a></td>";
                echo "</tr>\n";
            }
            ?>
        </table>
    </body>
</html>
