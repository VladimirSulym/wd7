<?php

class request
{
    use singletonTrait;

    private $langMap = [
        'en' => 'eng',
        'ru' => 'rus'
    ];
    public $controller;
    public $action;
    
    public $lang = 'rus'; // rus | eng
    
    public $form = false;

    public $get             = [];
    public $post            = [];
    public $requestPayload  = [];
    public $request         = [];
    public $server          = [];
    public $files           = [];

    private function __construct()
    {
        /*
        if (!empty($_FILES)) {
            $fileLoader = new fileLoader();
            $this->files = $fileLoader->save();
        }
        /**/

        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;
        $this->server = $_SERVER;

        $this->controller = $this->get['controller'] ?? 'site';
        $this->action = $this->get['action'] ?? 'index';
        
        $this->controller = str_replace(chr(0), '', $this->controller);
        $this->action = str_replace(chr(0), '', $this->action);

        $this->form = isset($this->post['submit']);
        $this->setRequestPayload();

        unset($this->get['controller'], $this->get['action'], $this->post['submit']);
    }
    
    private function setRequestPayload()
    {
        $inputString = '';
        // url | uri - universal resource identificator
        $std = fopen('php://input', 'r');
        while ($buf = fread($std, 1024)) {
            $inputString .= $buf;
        }
        fclose($std);
        $this->requestPayload = json_decode($inputString, true);
    }
    
    private function setLanguage()
    {
        $browserLocale = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $browserLocale = explode(';', $browserLocale);
        $browserLocale = reset($browserLocale);
        $browserLocale = explode(',', $browserLocale);
        $browserLocale = reset($browserLocale);
        $browserLocale = explode('-', $browserLocale);
        $browserLocale = reset($browserLocale);

        $this->lang = $this->langMap[$browserLocale];
    }
}