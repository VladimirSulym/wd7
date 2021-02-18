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

    public function renderPage($data = [])
    {
        $___PATH_TO_TEMPLATE_0014531____ = core::$config['app_path'] . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->layout . '.php';
        if (!file_exists($___PATH_TO_TEMPLATE_0014531____)) {
            throw new Exception('Template ' . $this->layout . ' not found');
        }
        extract($data);
        ob_start();
        include $___PATH_TO_TEMPLATE_0014531____;
        return ob_get_clean();
    }
}
