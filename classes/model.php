<?php

class model
{
    private $_db = false;
    protected $dbNode = 'local';

    public function __get($name)
    {
        if ($name == 'db') {
            return servers::getInstance()->getDbServer($this->dbNode);
        }
    }
}
