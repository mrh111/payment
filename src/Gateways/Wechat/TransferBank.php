<?php

namespace Payment\Gateways\Wechat;

use Payment\Contracts\IGatewayRequest;
use Payment\Exceptions\GatewayException;

/**
 * @package Payment\Gateways\Wechat
 * @desc    : 企业付款到银行卡API
 **/
class TransferBank extends WechatBaseObject implements IGatewayRequest
{
    const METHOD = 'mmpaysptrans/pay_bank';

    /**
     * @param array $requestParams
     * @return mixed
     */
    protected function getSelfParams(array $requestParams)
    {
        $totalFee = bcmul($requestParams['amount'], 100, 0);

        $selfParams = [
            'partner_trade_no' => $requestParams['trans_no'] ?? '',
            'enc_bank_no'      => $requestParams['enc_bank_no'] ?? '',
            'enc_true_name'    => $requestParams['enc_true_name'] ?? '',
            'bank_code'        => $requestParams['bank_code'] ?? '',
            'amount'           => $totalFee,
            'desc'             => $requestParams['desc'] ?? '',
        ];

        return $selfParams;
    }

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
}
