<?php
set_time_limit(0);
class MainController extends controller
{
    protected $layout = 'index';

    public function actionIndex()
    {
        $file = core::$config['app_path'] . DS . 'ubuntu.iso';
        if (!file_exists($file)) {
            die('FILE NOT FOUND');
        }
        //die('<<');
        /*
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        /**/
        $f = fopen($file, 'rb');
        $chunkSize = 4096;
        while ($chunk = fread($f, $chunkSize)) {
            echo $chunk;
        }
        fclose($f);
        // читаем файл и отправляем его пользователю
        //readfile($file);
        //exit;
        //$html = '<script>alert("aaa");</script>';
        //$html = '';
        //echo $this->renderPage(['CONTENT'=> $html]);
        /*
        $u = $this->getModel('users')->getUsers();
        
        $html = '<table>';
        foreach ($u as $user) {
            $html .= '<tr>';
            $html .= '<td><a href="/index.php?controller=main&action=delete&id=' . $user['id'] . '">Удалить</a></td>';
            $html .= '<td>' . $user['login'] . '</td>';
            $html .= '<td>' . $user['password'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        
        echo $this->renderPage(['CONTENT' => $html]);
        /**/
    }
    
    public function actionDelete()
    {
        $this->getModel('users')->deleteUser(request::getInstance()->get['id']);
        header('Location: /index.php?controller=main&action=index');
    }
    
    public function actionCatalog()
    {
        
        echo $this->renderPage(['CONTENT' => $this->renderTemplate('list', []), 'MENU' => $this->renderTemplate('menu', [])]);
        echo json_encode([
            'MENU' => $this->renderTemplate('menu'),
            'CONTENT' => $this->renderTemplate('list')
        ]);
    }
    
    public function actionRest()
    {
        echo json_encode(['success' => 1]);
        //$this->layout = 'test';
        //$rest = $this->renderPage();
        //$this->layout = 'index';
        //$this->templatesDir = 'layouts';
        //$this->templatesDir = 'layouts';
        //$content = $this->renderAll('main', 'usersList', ['zzz' => __METHOD__]);
        $model = $this->getModel('users');
        //$this->layout = 'test';
        $popup = $model->addedToCart() ? '' : 'Не Добавлено';
        echo $this->renderPage(['CONTENT' => '', 'popup' => $popup]);
    }
    
    public function actionRestAction()
    {
        echo json_encode(['success' => 1]);die();
        $content = $this->renderAll('main', 'usersList', ['zzz' => __METHOD__]);
        echo json_encode(['content' => $content]);
        die();
        $key = request::getInstance()->post['key'];
        $response = $key < 0.5 ? 'Не угадал' : '';
        echo json_encode(['success' => 1, 'popup' => $key]);
    }
}
