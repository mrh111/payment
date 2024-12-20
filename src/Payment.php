<?php


namespace Payment;


final class Payment
{
    const SUC = 0;

    // 代码级别错误
    const CLASS_NOT_EXIST    = 1000;
    const PARAMS_ERR         = 1001;
    const NOT_SUPPORT_METHOD = 1002;

    // 业务错误
    const SIGN_ERR        = 2001;
    const FORMAT_DATA_ERR = 2002;

    // 第三方错误
    const GATEWAY_REFUSE       = 3001;
    const GATEWAY_CHECK_FAILED = 3002;
    const NOTIFY_DATA_EMPTY    = 3003;
    const MCH_INFO_ERR         = 3004;
}
