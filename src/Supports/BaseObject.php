<?php


namespace Payment\Supports;

/**
 * Class Object
 * @package Payment\Supports
 * @desc    : 整个lib的基础类
 *
 */
abstract class BaseObject
{
    const VERSION = '5.0.0';

    /**
     * @var Config
     */
    public static $config = null;

    /**
     * 获取版本号
     * @return string
     */
    public static function getVersion()
    {
        return self::VERSION;
    }

    /**
     * 获取类名
     * @return string
     */
    public function className()
    {
        return get_called_class();
    }

    /**
     * 设置配置文件
     * @param array $config
     */
    public function setConfig(array $config)
    {
        self::$config = new Config($config);
    }

    /**
     * 项目根路径
     */
    public function getBasePath()
    {
        $path = realpath(dirname(dirname(__FILE__)));
        return $path;
    }
}
