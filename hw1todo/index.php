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
                <?php
                require_once 'db.php';

                $sql = "SELECT * FROM hw1todo";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "Error executing query [ $sql ] : " . mysqli_error($conn);
                }

                $datarows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                echo "<tr><th>#</th><th>Description</th><th>Due date</th><th>Is done</th></tr>";
                foreach ($datarows as $row) {
                    $ID = $row['ID'];
                    $desc = htmlentities($row['description']);
                    $dueDate = htmlentities($row['dueDate']);
                    $isDone = $row['isDone'];
                    echo "<tr><td>$ID</td><td>$desc</td><td>$dueDate</td><td>$isDone</td>";
                }
                ?>
            </table>
        </div>
    </center>
</body>
</html>
