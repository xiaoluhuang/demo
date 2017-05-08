<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/30
 * Time: 上午10:00
 */
require_once 'CacheBase.php';

class MY_Redis extends CacheBase
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
        echo __METHOD__;
        $this->_instance = new Redis();
        $this->_instance->connect('127.0.0.1', '6379');
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
        return $this->_instance->set($key, serialize($value), $time);
    }

    /**
     * get
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return unserialize($this->_instance->get($key));
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