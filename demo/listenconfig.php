<?php
/**
 * 监听配置：php listenconfig.php host:port dataid group tenant
 */
require_once __DIR__ . '/common.php';

$nacosService = isset($_SERVER['argv'][1])?$_SERVER['argv'][1]:"127.0.0.1:8848";
$nacosClientObj = \CjsNacos\NacosClient::getInstance()->setConfigServer($nacosService);

$nacosConfigObj = \CjsNacos\NacosConfig::getInstance()->setNacosClient($nacosClientObj);

$dataid = isset($_SERVER['argv'][2])?$_SERVER['argv'][2]:"env";
$group = isset($_SERVER['argv'][3])?$_SERVER['argv'][3]:"user_service";
$tenant = isset($_SERVER['argv'][4])?$_SERVER['argv'][4]:"";
$contentMd5 = '';

$loop = \CjsSignal\Loop::getInstance();
$i = 1;
while($loop()) {
    $listenContent = $nacosConfigObj->listenerConfig($dataid, $group,$tenant, $contentMd5);
    var_export($listenContent);
    if($listenContent['data']) {
        echo $listenContent['data'] . PHP_EOL;
        //获取配置
        $configContent = $nacosConfigObj->getConfig($dataid, $group, $tenant);
        $contentMd5 = md5($configContent['data']);
        //配置信息
        var_export($configContent);
    }

    echo $i . PHP_EOL;
    $i++;
}

echo 'finish' . PHP_EOL;

