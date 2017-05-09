<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/30
 * Time: 上午10:00
 */
require_once 'MY_Memcache.php';
require_once 'MY_Redis.php';
class Cache
{
    /**
     * memcached
     */
    const DRIVER_MEMCACHED = 'memcached';

    /**
     * redis
     */
    const DRIVER_REDIS = 'redis';

    /**
     * 驱动器实例
     * @var
     */
    private $_driver;

    public function __construct($driver = self::DRIVER_MEMCACHED)
    {
        $this->_driver = self::createCache($driver);
        $this->_driver->connect();
    }

    public function createCache($driver)
    {
        switch ($driver) {
            case self::DRIVER_MEMCACHED:
                return new MY_Memcache();
            case self::DRIVER_REDIS:
                return new MY_Redis();
            default:
                throw new Exception('invalid cache driver');
                break;
        }
    }


    /**
     * set
     * @param $key
     * @param $vaule
     * @param $time /s
     * @return mixed
     *
     */
    public function set($key, $value, $time = 30 * 60)
    {
        return $this->_driver->set($key, $value, $time);
    }

    /**
     * get
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->_driver->get($key);
    }

    /**
     * delete
     * @param $key
     * @return mixed
     */
    public function delete($key)
    {
        return $this->_driver->delete($key);
    }
}