<?php

class ErrorController extends controller
{
    public function action404()
    {
        die('z');
        echo '>>>>404 NOT FOUND!!!<<< ';
    }
    public function action401()
    {
        header('Location: /login?redirect_to=' . $_SERVER['REFERRER']);
        //echo '>>>>404 NOT FOUND!!!<<< ';
    }
}
