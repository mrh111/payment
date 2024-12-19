<?php

namespace Payment\Exceptions;

/**
 * @package Payment\Exceptions
 * @desc    :
 **/
class ClassNotFoundException extends \RuntimeException
{
    /**
     * GatewayErrorException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }
}
