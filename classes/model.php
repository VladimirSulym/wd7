<?php

class model
{
    private $_db = false;
    private $_queryBuilder = false;
    protected $dbNode = 'local';

    public function __get($name)
    {
        if ($name == 'db') {
            return servers::getInstance()->getDbServer($this->dbNode);
        } elseif ($name == 'queryBuilder') {
            if ($this->_queryBuilder == false) {
                $this->_queryBuilder = new pgQueryBuilder($this->db);
            }
            return $this->_queryBuilder;
        }
    }
}
