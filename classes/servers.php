<?php

class servers
{
    use singletonTrait;

    private $servers = [];

    public function getDbServer($nodeName = 'local')
    {
        if (!isset($this->servers[$nodeName])) {
            $dbType = core::$config['db'][$nodeName]['type'];
            $this->servers[$nodeName] = new $dbType(core::$config['db'][$nodeName]);
        }
        return $this->servers[$nodeName];
    }
}
