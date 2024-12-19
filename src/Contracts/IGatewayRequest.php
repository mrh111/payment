<?php

namespace Payment\Contracts;

use Payment\Exceptions\GatewayException;

/**
 * @package Payment\Contracts
 * @desc    : 网关功能标准接口
 **/
interface IGatewayRequest
{
    /**
     * 获取第三方返回结果
     * @param array $requestParams
     * @return mixed
     * @throws GatewayException
     */
    public function request(array $requestParams);
}
