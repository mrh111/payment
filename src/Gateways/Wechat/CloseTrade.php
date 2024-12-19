<?php

namespace Payment\Gateways\Wechat;

use Payment\Contracts\IGatewayRequest;
use Payment\Exceptions\GatewayException;
use Payment\Payment;

/**
 * @package Payment\Gateways\Wechat
 * @desc    : 关闭交易
 **/
class CloseTrade extends WechatBaseObject implements IGatewayRequest
{
    const METHOD = 'pay/closeorder';

    /**
     * 获取第三方返回结果
     * @param array $requestParams
     * @return mixed
     * @throws GatewayException
     */
    public function request(array $requestParams)
    {
        try {
            return $this->requestWXApi(self::METHOD, $requestParams);
        } catch (GatewayException $e) {
            throw $e;
        }
    }

    /**
     * @param array $requestParams
     * @return mixed
     */
    protected function getSelfParams(array $requestParams)
    {
        $selfParams = [
            'out_trade_no' => $requestParams['trade_no'] ?? '',
        ];

        return $selfParams;
    }
}
