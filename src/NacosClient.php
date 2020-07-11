<?php
/**
 * nacos服务配置
 */
namespace CjsNacos;

class NacosClient
{
    protected $configServer = "http://127.0.0.1:8848"; //nacos服务端地址和监听的端口,示例：http://127.0.0.1:8848

    public static function getInstance() {
        return new static();
    }

    public function getConfigServer()
    {
        return $this->configServer;
    }

    public function setConfigServer($configServer)
    {
        $this->configServer = rtrim($configServer, '/\\');
        return $this;
    }

}