<?php

class controller
{
    protected $layout = 'index';
    protected $templatesDir = '';
    private $allData = [];
    private $models = [];

    public function __construct()
    {
        
    }

    public function getModel($modelName, $isNew = false)
    {
        if (!isset($this->models[$modelName])) {
            if (!file_exists(core::$config['app_path'] . DS . 'app' . DS . 'models' . DS . $modelName . '.php')) {
                throw new Exception('Model class ' . $modelName . ' not exists');
            }
            include core::$config['app_path'] . DS . 'app' . DS . 'models' . DS . $modelName . '.php';
            $this->models[$modelName] = new $modelName;
        }
        return $isNew ? (new $modelName) : $this->models[$modelName];
    }

    public function renderTemplate($templateName, $data = [])
    {
        if (empty($this->templatesDir)) {
            $this->templatesDir = request::getInstance()->controller;
        }
        return $this->renderAll($this->templatesDir, $templateName, $data);
    }

    public function renderPage($data = [])
    {
        return $this->renderAll('layouts', $this->layout, $data);
    }
    
    protected function renderAll($dir, $template, $data = [])
    {
        $___PATH_TO_TEMPLATE_0014531____ = core::$config['app_path'] . DS . 'app' . DS . 'views' . DS . $dir . DS . $template . '.php';
        if (!file_exists($___PATH_TO_TEMPLATE_0014531____)) {
            throw new Exception('Template ' . $dir . '/' . $template . ' not found');
        }
        extract($data);
        ob_start();
        include $___PATH_TO_TEMPLATE_0014531____;
        return ob_get_clean();
    }
}
