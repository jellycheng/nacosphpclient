<?php
/**
 * nacos配置管理：发布配置、获取配置
 * User: jelly
 * Date: 2020/7/11
 * Time: 13:54
 */

namespace CjsNacos;

use CjsCurl\Curl;
class NacosConfig
{
    protected $nacosClient;

    public static function getInstance() {
        static $instance;
        if($instance != null) {
            return $instance;
        }
        $instance = new static();
        return $instance;
    }

    public function setNacosClient($nacosClientObj) {
        $this->nacosClient = $nacosClientObj;
        return $this;
    }

    /**
     *
     * 发布配置，post请求
     * @param $dataId
     * @param $group
     * @param $content
     * @param $tenant 租户信息，对应 Nacos 的命名空间ID值字段，不是命名空间名称
     * @param $type 配置类型
     */
    public function publishConfig($dataId, $group, $content,$tenant = '',$type='') {
        $url = sprintf("%s/nacos/v1/cs/configs?dataId=%s&group=%s&content=%s",
                        $this->nacosClient->getConfigServer(),
                        $dataId,
                        $group,
                        $content
                    );
        if($tenant) {
            $url .= "&tenant=" . $tenant;
        }
        if($type) {
            $url .= "&type=" . $type;
        }


    }

    /**
     * 获取配置，get请求
     * @param $dataId
     * @param $group
     * @param $tenant 租户信息，对应 Nacos 的命名空间ID字段
     */
    public function getConfig($dataId, $group,$tenant = '') {
        $ret = [
            'code'=>'',
            'msg'=>'',
            'data'=>'',
        ];
        $url = sprintf("%s/nacos/v1/cs/configs?dataId=%s&group=%s",
                        $this->nacosClient->getConfigServer(),
                        $dataId,
                        $group
                        );
        if($tenant) {
            $url .= "&tenant=" . $tenant;
        }
        $curlObj = Curl::boot()->get($url);
        $ret['code'] = $curlObj->getErrno();
        $content = '';
        if(!$ret['code']) {
            $content = $curlObj->getResponse(); //内容
        } else {
            $ret['msg'] = $curlObj->getErrmsg();
        }
        $ret['data'] = $content;
        return $ret;
    }

    public function listenerConfig($ListeningConfigs, $timeout = 30000) {
        $url = sprintf("%s/nacos/v1/cs/configs/listener",
                        $this->nacosClient->getConfigServer()
                    );


    }

    /**
     * 删除配置，delete请求
     * @param $dataId
     * @param $group
     * @param $tenant 租户信息，对应 Nacos 的命名空间ID字段
     */
    public function deleteConfig($dataId, $group,$tenant = '') {

        $url = sprintf("%s/nacos/v1/cs/configs?dataId=%s&group=%s",
            $this->nacosClient->getConfigServer(),
            $dataId,
            $group
        );
        if($tenant) {
            $url .= "&tenant=" . $tenant;
        }

    }

}