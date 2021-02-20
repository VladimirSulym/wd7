<?php

class users extends model
{
    public function addedToCart()
    {
        return false;
    }

    public function __construct()
    {
        
    }

    public function getUsers()
    {
        return $this->db->querySelect('select * from users');
    }

    public function deleteUser($id)
    {
        $this->db->query('delete from users where id=' . $this->db->escape($id));
    }
}