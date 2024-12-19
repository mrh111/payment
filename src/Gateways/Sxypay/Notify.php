<?php

namespace Payment\Gateways\Sxypay;

use Payment\Exceptions\GatewayException;
use Payment\Payment;

class Notify extends SxyBaseObject
{

    public function request(){
        $resArr = $this->getNotifyData();
        if (empty($resArr)) {
            throw new GatewayException('the notify data is empty', Payment::NOTIFY_DATA_EMPTY);
        }
    }

    /**
     * 获取异步通知数据
     * @return array
     */
    protected function getNotifyData()
    {
        $data = empty($_POST) ? $_GET : $_POST;
        if (empty($data) || !is_array($data)) {
            return [];
        }

        return $data;
    }

    /**
     * 响应数据
     * @param bool $flag
     * @return string
     */
    public function response(bool $flag)
    {
        if ($flag) {
            return 'success';
        }
        return 'fail';
    }

    /**
     * notify 不需要该方法，不实现
     * @param array $requestParams
     * @return mixed
     */
    protected function getBizContent(array $requestParams)
    {
        return [];
    }
}