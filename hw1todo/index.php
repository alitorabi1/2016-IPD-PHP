<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP - Home work #1</title>
        <style>
            #divAddItem {
                padding: 10px;
                margin-right: 200px;
                text-align: right;
            }

            #tblData {
                border-collapse: collapse;
                border: 1px solid black;
                width: 49%;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div id="divAddItem">
            <a href="add.php">Add Item</a>
        </div>

    <center>
        <div id="divData">
            <table id="tblData" border>
            <tr><th>#</th><th>Description</th><th>Due date</th><th>Is done</th><th colspan="2">operations</th></tr>
                <?php
                require_once 'db.php';

                $sql = "SELECT * FROM hw1todo";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Error executing query [ $query ] : " . mysqli_error($conn));
                }

                $datarows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($datarows as $row) {
                    $ID = $row['ID'];
                    $desc = htmlentities($row['description']);
                    $dueDate = htmlentities($row['dueDate']);
                    $isDone = $row['isDone'];
                    echo "<tr><td>$ID</td><td>$desc</td><td>$dueDate</td><td>$isDone</td>\n";
                    echo "<td><a href=\"itemdelete.php?id=$ID\">Delete</td>\n";
                    echo "<td><a href=\"itemedit.php?id=$ID\">Edit</td>\n";
                    echo "</tr>\n";
                }
                ?>
            </table>
        </div>
    </center>
</body>
</html>
