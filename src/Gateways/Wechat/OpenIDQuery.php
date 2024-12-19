<?php

namespace Payment\Gateways\Wechat;

use Payment\Contracts\IGatewayRequest;
use Payment\Exceptions\GatewayException;

/**
 * @package Payment\Gateways\Wechat
 * @desc    : 查询openid
 **/
class OpenIDQuery extends WechatBaseObject implements IGatewayRequest
{
    const METHOD = 'tools/authcodetoopenid';

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
            'auth_code' => $requestParams['auth_code'] ?? '', // 扫码支付授权码，设备读取用户微信中的条码或者二维码信息
        ];

        return $selfParams;
    }
}
