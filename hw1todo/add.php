<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP - Home work #1</title>
        <style>
            .contact_form input:focus:invalid, .contact_form textarea:focus:invalid { /* when a field is considered invalid by the browser */
                box-shadow: 0 0 5px #d45252;
                border-color: #b03535
            }
            .contact_form input:required:valid, .contact_form textarea:required:valid { /* when a field is considered valid by the browser */
                box-shadow: 0 0 5px #5cd053;
                border-color: #28921f;
            }        </style>
    </head>
    <body>

        <form method="post" action="receiver.php" class="contact_form">
            <label for="txtDescription">Description: </label>
            <textarea name="txtDescription" cols="40" rows="6" required></textarea>
            <br><br>
            Due date: <input type="text" placeholder="YYYY-MM-DD" name="txtDueDate" required/>
            <br><br>
            <input type="submit" value=" Add " />
        </form>
    </body>
</html>
