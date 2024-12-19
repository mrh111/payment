<?php

namespace Payment\Gateways\Sxypay;

use Payment\Supports\BaseObject;
use Payment\Supports\HttpRequest;

abstract class SxyBaseObject extends BaseObject
{
    use HttpRequest;

    protected $privateKey = '';

    protected $publicKey = '';

    protected $gatewayUrl = '';

    protected $isSandbox = false;

    protected $returnRaw = false;

    public function __construct()
    {
        $this->isSandbox = self::$config->get('use_sandbox', false);
        $this->returnRaw = self::$config->get('return_raw', false);
    }
}