<?php

class UserController extends controller
{
    public function actionRegistration()
    {
        if (request::getInstance()->form) {
            $model = $this->getModel('users');
            $token = $model->registration(request::getInstance()->post);
            header('location:' . core::url('user', 'login') . '&token=' . $token);
        }

        echo $this->renderPage([
            'content' => $this->renderTemplate('registration')
        ]);
    }
    
    public function actionLogin()
    {
        $error = '';
        if (request::getInstance()->form) {
            $model = $this->getModel('users');
            try {
                $model->login(request::getInstance()->post);
                header('location:' . core::url('user', 'list'));
                return;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        echo $this->renderPage([
            'content' => $this->renderTemplate('login', array_merge(request::getInstance()->post, [
                'token' => request::getInstance()->get['token'] ?? '',
                'error' => $error
            ]))
        ]);
    }
    
    public function actionList()
    {
        $model = $this->getModel('users');
        if ($model->isGuest()) {
            echo 'Я гость';
        } else {
            echo 'Вы вошли как ' . $_SESSION['email'];
        }
    }
}
