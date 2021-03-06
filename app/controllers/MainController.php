<?php

class MainController extends controller
{
    protected $layout = 'index';

    public function actionIndex()
    {
        //$html = '<script>alert("aaa");</script>';
        $html = '';
        echo $this->renderPage(['CONTENT'=> $html]);
        //sleep(5);
        echo $this->renderPage(['CONTENT'=> null]);

        $html = $this->renderTemplate('usersList');
        echo $this->renderPage(['CONTENT' => $html]);
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
