<?php

/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/30
 * Time: 上午10:00
 */
abstract class CacheBase
{


    /**
     * connect
     */
    function connect(){}

    /**
     * set
     * @param $key
     * @param $vaule
     * @param $time /s
     * @return mixed
     *
     */
    function set($key, $value, $time) {}

    /**
     * get
     * @param $key
     * @return mixed
     */
     function get($key) {}

    /**
     * delete
     * @param $key
     * @return mixed
     */
     function delete($key) {}
}