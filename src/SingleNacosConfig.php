<?php
namespace CjsNacos;


class SingleNacosConfig extends NacosConfig
{

    public static function getInstance() {
        static $instance = null;
        if($instance != null) {
            return $instance;
        }
        $instance = new static();
        return $instance;
    }

    protected function __construct() {

    }

    private function __clone() {

    }

    private function __wakeup() {

    }

}