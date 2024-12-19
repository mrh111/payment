<?php

namespace Payment\Gateways\Wechat;

use Payment\Contracts\IGatewayRequest;
use Payment\Exceptions\GatewayException;

/**
 * @package Payment\Gateways\Wechat
 * @desc    : 回退交易的查询
 **/
class ProfitShareRefundQuery extends WechatBaseObject implements IGatewayRequest
{
    const METHOD = 'pay/profitsharingreturnquery';

    /**
     * 获取第三方返回结果
     * @param array $requestParams
     * @return mixed
     * @throws GatewayException
     */
    public function request(array $requestParams)
    {
        $this->setSignType(self::SIGN_TYPE_SHA);
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
            'order_id'      => $requestParams['order_id'] ?? '',
            'out_order_no'  => $requestParams['out_order_no'] ?? '',
            'out_return_no' => $requestParams['out_return_no'] ?? '',
        ];

        return $selfParams;
    }
}
