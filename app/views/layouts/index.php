<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <style>
            body {
                margin: 0px;
                padding: 0px;
                width: 100%;
                height: 100%;
            }
            #header {
                width: 100%;
                height: 50px;
                position: fixed;
                top: 0;
                left: 0px;
                background: #f0f0f0;
                border-bottom: 1px solid #000;
            }
            #pageBlock {
                background: #0f0;
                margin: 60px auto;
                width :1024px;
            }
            #leftMenu {
                width: 310px;
                margin-right: 4px;
                background: #c0c0c0;
                float: left;
            }
            #pageContent {
                width: 710px;
                background: #c0c0c0;
                float: right;
            }
            #popup {
                border: 1px solid red;
                padding: 10px;
                position: absolute;
                top: 10px;
                left:10px;
                z-index: 1000;
                background: #fcd;
                display: none;
            }
        </style>
        <script src="jquery.js"></script>
    </head>
    <body>
        <div id="popup">
        </div>
        <div id="header">
            <script>
                function sendAction()
                {
                    var key = Math.random();
                    console.log(key);
                    $.ajax({
                        url: '/?controller=main&action=restAction',
                        data: {key: key},
                        method: 'POST',
                        dataType: 'JSON',
                        success: function (r) {
                            $('#pageContent').html(r.content);
                        }
                    });
                }
            </script>
            <input type="button" onclick="sendAction();">br /<>
        </div>
        <div id="pageBlock">
            <div id="leftMenu">
            </div>
            <div id="pageContent">
                <?php echo $CONTENT; ?>
            </div>
        </div>
    </body>
</html>