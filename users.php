<?php
    include 'db.php';
    $users = $psql->querySelect('SELECT * FROM users');
    $userId = $_GET['id'] ?? 0;

    $user = $psql->querySelect('SELECT * FROM users WHERE id=' . $psql->escape($userId));
    if (!empty($user)) {
        $user = reset($user);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <script src="jquery.js"></script>
        <style>
            #addUser {
                width: 400px;
                height: 100px;
                margin: 0px auto;
                background: #c0c0c0;
                margin-bottom: 10px;
                text-align: center;
                padding: 10px;
            }
            #list {
                width: 1024px;
                margin: 10px auto;
                border: 1px solid #000;
            }
            table td {
                border: 1px solid #000;
            }
        </style>
        <script>
            function sendUser()
            {
                var formData = {
                    id: $('input[name=id]').val(),
                    login: $('input[name=login]').val(),
                    password: $('input[name=password]').val()
                };
                $.ajax({
                    url: '/userSaver.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: formData,
                    success: function (resp) {
                        if (resp.success == 1) {
                            //window.location = '/users.php';
                        }
                        console.log(resp);
                    }
                });
            }
        </script>
    </head>
    <body>
        <form id="addUser" method="POST" action="/userSaver.php">
            <input type="hidden" name="id" value="<?php echo $userId; ?>" />
            <input type="text" name="login" value="<?php echo $user['login'] ?? ''; ?>" /><br />
            <input type="password" name="password" /><br />
            <input type="button" onclick="sendUser();" name="send" />
        </form>
        
        <table>
            <tr>
                <th>Редактировать</th>
                <th>Удалить</th>
                <th>Логин</th>
                <th>Пароль</th>
            </tr>
            <?php foreach ($users as $user) { ?>
            <tr>
                <td><a href="/users.php?id=<?php echo $user['id']; ?>">X</a></td>
                <td><a href="/userDelete.php?id=<?php echo $user['id']; ?>">X</a></td>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['password']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>