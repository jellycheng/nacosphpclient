<?php
/**
 * 获取配置：php getconfig.php host:port dataid group tenant
 */
require_once __DIR__ . '/common.php';

$nacosService = isset($_SERVER['argv'][1])?$_SERVER['argv'][1]:"127.0.0.1:8848";
$nacosClientObj = \CjsNacos\NacosClient::getInstance()->setConfigServer($nacosService);

$nacosConfigObj = \CjsNacos\SingleNacosConfig::getInstance()->setNacosClient($nacosClientObj);

$dataid = isset($_SERVER['argv'][2])?$_SERVER['argv'][2]:"env";
$group = isset($_SERVER['argv'][3])?$_SERVER['argv'][3]:"user_service";
$tenant = isset($_SERVER['argv'][4])?$_SERVER['argv'][4]:"";
$configContent = $nacosConfigObj->getConfig($dataid, $group, $tenant);
var_export($configContent);
echo PHP_EOL;
