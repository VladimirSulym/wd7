<?php

class MainController extends controller
{
    protected $layout = 'index';

    public function actionIndex()
    {
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
    }
    
    public function actionDelete()
    {
        $this->getModel('users')->deleteUser(request::getInstance()->get['id']);
        header('Location: /index.php?controller=main&action=index');
    }
}
