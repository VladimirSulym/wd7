<?php

class MainController extends controller
{
    protected $layout = 'index';

    public function actionIndex()
    {
        $users = $this->getModel('users')->getUsers();
        $content = $this->renderTemplate('usersList', ['users' => $users]);
        echo $this->renderPage(['CONTENT' => $content]);
    }
    
    public function actionDelete()
    {
        $this->getModel('users')->deleteUser(request::getInstance()->get['id']);
        header('Location: /index.php?controller=main&action=index');
    }
}
