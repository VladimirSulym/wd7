<?php
/* /book ///list
 *          GET      VIEW
 * GET x2 /book || /book/12
 * POST
 * PUT
 * DELETE /book/12
 * 
 * OPTION
 * PATH
 */

spl_autoload_register(function ($name) {
    $name = str_replace('\\', '/', ltrim($name, '\\'));

    if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . $name . '.php')) {
        die('Class>>> ' . $name . ' not found');
    }

    include __DIR__ . DIRECTORY_SEPARATOR . $name . '.php';
});

class core
{
    public static $config = [];
    
    public function __construct($config = [])
    {
        self::$config = $config;
    }

    public function run()
    {
        try {
            $this->startAction(request::getInstance()->controller, request::getInstance()->action);
        } catch (httpException $e) {
            $this->startAction('error', (string) $e->getCode());
        } catch (Exception $e) {
            die('ALARM: ' . $e->getMessage());
        }
    }

    private function startAction($controller, $action)
    {
        $controllerName = ucfirst(strtolower($controller)) . 'Controller';
        $actionName     = 'action' . ucfirst(strtolower($action));
        if (!file_exists(self::$config['controllers_path'] . DIRECTORY_SEPARATOR . $controllerName . '.php')) {
            throw new httpException('Controller ' . $controller . '  file not exists', 404);
        }

        include self::$config['controllers_path'] . DIRECTORY_SEPARATOR . $controllerName . '.php';

        if (!class_exists($controllerName)) {
            throw new httpException('Class ' . $controller . ' not exists', 404);
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $actionName)) {
            throw new httpException('Action ' . $action . ' not exists', 404);
        }

        $controller->$actionName();
        $controller->response();
        return true;
    }
}
