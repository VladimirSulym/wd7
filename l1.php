<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <script src="jquery.js"></script>
        <script>
            function sendForm()
            {
                $.ajax({
                    url: 'l2.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        string: $('input[name=string]').val()
                    },
                    success: function (r) {
                        if (r.success == 1) {
                            var html = '<a href="/l3.php?id=' + r.string + '">*' + r.string + '</a><br />';
                            $('#before').prepend(html);
                        } else {
                            $('#error').css('display', 'block');
                            $('#error').html('Errrooororor');
                        }
                        //['success' => 1 | 0, 'string': string]
                    }
                });
            }
        </script>
    </head>
    <body>
        <div style="background: #fcc; padding: 10px; border: 1px solid #f00;display: none;" id="error"></div>
        <div style="width :300px;margin: 0px auto; border:  1px solid #f00; padding: 10px;">
        <?php
        include 'db.php';
        foreach ($psql->querySelect('select * from text') as $line) {
        ?>
            <a href="/l3.php?id=<?php echo $line['string']; ?>"><?php echo $line['string']; ?></a><br />
        <?php
        }
        ?>
            <div id="before"></div>
        </div>
        <form action="/l2.php" method="POST">
            <input type="text" name="string" />
            <input type="button" onclick="sendForm();return false;">
        </form>
    </body>
</html>
