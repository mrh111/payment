<?php

namespace Payment\Gateways\Wechat;

use Payment\Contracts\IGatewayRequest;
use Payment\Exceptions\GatewayException;

/**
 * @package Payment\Gateways\Wechat
 * @desc    : 撤销订单，支付交易返回失败或支付系统超时，调用该接口撤销交易
 **/
class CancelTrade extends WechatBaseObject implements IGatewayRequest
{
    const METHOD = 'secapi/pay/reverse';

    /**
     * @param array $requestParams
     * @return mixed
     * @throws GatewayException
     */
    protected function getSelfParams(array $requestParams)
    {
        try {
            return $this->requestWXApi(self::METHOD, $requestParams);
        } catch (GatewayException $e) {
            throw $e;
        }
    }

    /**
     * 获取第三方返回结果
     * @param array $requestParams
     * @return mixed
     */
    public function request(array $requestParams)
    {
        $selfParams = [
            'transaction_id' => $requestParams['transaction_id'] ?? '',
            'out_trade_no'   => $requestParams['trade_no'] ?? '',
        ];

        return $selfParams;
    }
}
