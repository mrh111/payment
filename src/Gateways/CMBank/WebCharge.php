<?php

namespace Payment\Gateways\CMBank;

use Payment\Contracts\IGatewayRequest;
use Payment\Exceptions\GatewayException;

/**
 * @package Payment\Gateways\CMBank
 * @desc    : pc支付
 **/
class WebCharge extends CMBaseObject implements IGatewayRequest
{
    const METHOD = 'netpayment/BaseHttp.dll?PC_EUserPay';

    /**
     * 获取第三方返回结果
     * @param array $requestParams
     * @return mixed
     * @throws GatewayException
     */
    public function request(array $requestParams)
    {
        $this->gatewayUrl = 'https://netpay.cmbchina.com/%s';
        if ($this->isSandbox) {
            $this->gatewayUrl = 'http://121.15.180.66:801/%s';
        }

        try {
            return $this->requestCMBApi(self::METHOD, $requestParams);
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
        $nowTime    = time();
        $timeExpire = $requestParams['time_expire'] ?? 0;
        $timeExpire = $timeExpire - $nowTime;
        if ($timeExpire < 3) {
            $timeExpire = 30; // 如果设置不合法，默认改为30
        }

        $params = [
            'dateTime'         => date('YmdHis', $nowTime),
            'branchNo'         => self::$config->get('branch_no', ''),
            'merchantNo'       => self::$config->get('mch_id', ''),
            'date'             => date('Ymd', $requestParams['date'] ?? $nowTime),
            'orderNo'          => $requestParams['trade_no'] ?? '',
            'amount'           => $requestParams['amount'] ?? '', // 固定两位小数，最大11位整数
            'expireTimeSpan'   => $timeExpire,
            'payNoticeUrl'     => self::$config->get('notify_url', ''),
            'payNoticePara'    => $requestParams['return_param'] ?? '',
            'productDesc'      => $requestParams['body'] ?? '',
            'returnUrl'        => self::$config->get('return_url', ''),
            'clientIP'         => $requestParams['client_ip'] ?? '',
            'cardType'         => self::$config->get('limit_pay', ''), // A:储蓄卡支付，即禁止信用卡支付
            'agrNo'            => $requestParams['agr_no'] ?? '',
            'merchantSerialNo' => $requestParams['merchant_serial_no'] ?? '',
            'userID'           => $requestParams['user_id'] ?? '',
            'mobile'           => $requestParams['mobile'] ?? '',
            'lon'              => $requestParams['lon'] ?? '',
            'lat'              => $requestParams['lat'] ?? '',
            'riskLevel'        => $requestParams['risk_level'] ?? '',
            'signNoticeUrl'    => self::$config->get('sign_notify_url', ''),
            'signNoticePara'   => $requestParams['return_param'] ?? '',
            //'encrypType' => '',
            //'encrypData' => '',
        ];

        return $params;
    }
}
