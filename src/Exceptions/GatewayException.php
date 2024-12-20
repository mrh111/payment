<?php

namespace Payment\Exceptions;

/**
 * @package Payment\Exception
 * @desc    :
 **/
class GatewayException extends \Exception
{
    /**
     * @var array
     */
    private $raw = [];

    /**
     * GatewayErrorException constructor.
     * @param string $message
     * @param int $code
     * @param mixed $raw
     */
    public function __construct(string $message, int $code, $raw = [])
    {
        parent::__construct($message, $code);

        $this->raw = $raw;
    }

    /**
     * @return array
     */
    public function getRaw()
    {
        return $this->raw;
    }
}
