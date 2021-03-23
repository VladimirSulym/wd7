<?php
if (isset($_GET['id']))  {
    //echo file_get_contents('...');
    header ('Content-Type: image/png');
    $im = @imagecreatetruecolor(800, 600) or die('Невозможно инициализировать GD поток');

    $ink = imagecolorallocate($im, 255, 0, 0);
    imagerectangle($im, 10, 10, random_int(100, 600), 100, $ink);

    imagepng($im);
    imagedestroy($im);
//die();
}
