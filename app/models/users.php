<?php

session_start();

class users extends model
{
    public function __construct()
    {
        if (!isset($_SESSION['id'])) {
            if (isset($_COOKIE['token'])) {
                $dbUser = $this->db->querySelect("select id, email, status from users where token='" . $this->db->escape($_COOKIE['token']) . "'");
                if (!empty($dbUser)) {
                    $_SESSION = reset($dbUser);
                    setcookie('token', $_COOKIE['token'], time() + 366 * 86400, '/');
                }
            }
        }
    }
    
    public function logout()
    {
        setcookie('token', '', time() - 1, '/');
        $this->db->query("Update users set token='' where id=" . $_SESSION['id']);
        $_SESSION = [];
    }
    
    public function isGuest()
    {
        return !isset($_SESSION['id']);
    }

    public function login(array $user)
    {
        $user = $this->authenticate($user);
        $this->authotization($user);
    }

    private function authotization(array $user)
    {
        $token = $this->getToken();
        $this->db->query("UPDATE users SET token='" . $token . "' where id=" . $user['id']);
        setcookie('token', $token, time() + 366 * 86400, '/');
        unset($user['password'], $user['salt'], $user['token']);
        $_SESSION = $user;
    }    

    private function authenticate(array $user)
    {
        $dbUser = $this->db->querySelect('select * from users where email=\'' . $this->db->escape($user['email']) . "'");
        if (empty($dbUser)) {
            throw new Exception('Emaail not exists');
        }
        $dbUser = reset($dbUser);
        if ($this->getPasswordHash($user['password'], $dbUser['salt']) != $dbUser['password']) {
            throw new Exception('Incorrect password');
        }
        
        if ($dbUser['status'] == 1) {
            if ($dbUser['token'] != $user['token']) {
                throw new Exception('Incorrect activation token');
            } else {
                $this->db->query("UPDATE users SET token='', status=0 where id=" . $dbUser['id']);
                $dbUser['token'] = '';
                $dbUser['status'] = 0;
            }
        }
        return $dbUser;
    }

    public function registration(array $user)
    {
        $salt = $this->getToken();
        $token = $this->getToken();
        $insData = [
            'email' => $this->db->escape($user['email']),
            'password' => $this->getPasswordHash($user['password'], $salt),
            'salt' => $salt,
            'status' => 1,
            'token' => $token
        ];
        $this->db->query("INSERT INTO users (" . implode(',', array_keys($insData)) . ") VALUES ('" . implode("','", $insData) . "')");
        return $token;
    }
    
    
    protected function getPasswordHash($password, $salt)
    {
        return md5(md5($password) . $salt);
    }

    protected function getToken($enthropy = 512)
    {
        return md5(random_bytes($enthropy));
    }
}
