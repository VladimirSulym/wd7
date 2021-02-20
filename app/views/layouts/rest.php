<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    </head>
    <body>
        <table>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
            <?php foreach ($rest as $row) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>                       
                    <td><?php echo $row['age']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <div name="POST" style="border: 1px solid black; width: 33%">
            <h3>POST</h3>
            <form name="POST" method="POST">
                <input type="text" name='name' placeholder="name">
                <input type="text" name='age' placeholder="age">
                <input type="submit" name='submit' value='Submit'>
            </form>            
        </div>
        <form method='POST'>
            <input type='hidden' method='DELETE'>
            <input type='submit' name='submit' value='Delete me'>
        </form>
    </body>
</html>