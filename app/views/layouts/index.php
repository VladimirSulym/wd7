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
        </style>
    </head>
    <body>
        <div id="header">
            asdas
        </div>
        <div id="pageBlock">
            <div id="leftMenu">
                <!--
                <?php foreach ($categories as $category ) { ?>
                    <a href="/index.php?controller=main&action=index&category=<?php echo $category['link']; ?>"><?php echo $category['name']; ?></a><br />
                <?php } ?>
                -->
            </div>
            <div id="pageContent">
                <?php echo $CONTENT; ?>
            </div>
        </div>
    </body>
</html>