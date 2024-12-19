<?php

namespace Payment\Gateways\CMBank;

use Payment\Contracts\IGatewayRequest;
use Payment\Exceptions\GatewayException;

/**
 * @package Payment\Gateways\CMBank
 * @desc    : 对账文件下载
 **/
class Bill extends CMBaseObject implements IGatewayRequest
{
    const METHOD = 'NetPayment/BaseHttp.dll?GetDownloadURL';

    const SANDBOX_METHOD = 'NetPayment_dl/BaseHttp.dll?GetDownloadURL';

    /**
     * 获取第三方返回结果
     * @param array $requestParams
     * @return mixed
     * @throws GatewayException
     */
    public function request(array $requestParams)
    {
        $method           = self::METHOD;
        $this->gatewayUrl = 'https://payment.ebank.cmbchina.com/%s';
        if ($this->isSandbox) {
            $method           = self::SANDBOX_METHOD;
            $this->gatewayUrl = 'http://121.15.180.66:801/%s';
        }
        try {
            return $this->requestCMBApi($method, $requestParams);
        } catch (GatewayException $e) {
            throw $e;
        }
    }

    /**
     * @param array $requestParams
     * @return mixed
     */
    protected function getRequestParams(array $requestParams)
    {
        $nowTime = time();

        $params = [
            'dateTime'     => date('YmdHis', $nowTime),
            'branchNo'     => self::$config->get('branch_no', ''),
            'merchantNo'   => self::$config->get('mch_id', ''),
            'date'         => date('Ymd', $requestParams['date'] ?? $nowTime),
            'transactType' => '4001',
            'fileType'     => 'YBL',
            'messageKey'   => $requestParams['message_key'] ?? '', // 交易流水，合作方内部唯一流水
        ];

        return $params;
    }
}
