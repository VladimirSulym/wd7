<?php

class pgsql
{
    private $connect = false;

    public function __construct($dbParams = [])
    {
        $this->connect = pg_connect('host=' . $dbParams['host'] .
            ' port='. $dbParams['port'] . 
            ' user=' . $dbParams['login'] . 
            ' password=' . $dbParams['password'] . 
            ' dbname=' . $dbParams['name']
        );
    }

    public function query($sql)
    {
        return pg_query($this->connect, $sql);
    }
    
    public function querySelect($sql)
    {
        $res = pg_query($this->connect, $sql);
        $out = [];
        while ($row = pg_fetch_assoc($res)) {
            $out[] = $row;
        }
        return $out;
    }
    
    public function escape($data = '')
    {
        return pg_escape_string($this->connect, $data);
    }
}
