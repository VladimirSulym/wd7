<?php

class model
{
    private $_db = false;

    public function __get($name)
    {
        if ($name == 'db') {
            if (empty($this->_db)) {
                $this->_db = new pgsql(core::$config['db']['local']);
            }
            return $this->_db;
        }
    }
}
