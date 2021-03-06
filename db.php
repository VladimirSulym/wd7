<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'classes/pgsql.php';
$config = [
    'host' => '127.0.0.1', //'localhost'
    'port' => 5432,
    'login' => 'skinner',
    'password' => 'test',
    'name' => 'wd7'
];
$psql = new pgsql($config);
//$psql->connect($config);