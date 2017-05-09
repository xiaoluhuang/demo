<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/30
 * Time: 上午10:00
 */
require_once 'CacheBase.php';

class MY_Memcache extends CacheBase
{
    /**
     * 驱动器实例
     * @var
     */
    private $_instance;

    /**
     * connect
     */
    public function connect()
    {
        $this->_instance = new Memcache();
        $this->_instance->connect('127.0.0.1', '11211');
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
        echo __METHOD__;
        return $this->_instance->set($key, $value, MEMCACHE_COMPRESSED, $time);
    }

    /**
     * get
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        echo __METHOD__;
        return $this->_instance->get($key);
    }

    /**
     * delete
     * @param $key
     * @return mixed
     */
    public function delete($key)
    {
        return $this->_instance->delete($key);
    }
}