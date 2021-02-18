<?php

trait singletonTrait
{
    private static $instance = null;

    private function __wakeup(){}
    private function __clone() {}
    private function __construct() {}

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance; 
    }
}
