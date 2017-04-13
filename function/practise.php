<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/20
 * Time: 上午11:37
 */
//练习代码规范,顺便把单例模式写一下
/*
 * 类的第一个字母要大写
 */

class Singleton
{
    public static $_instance;//实例化对象的接收变量

    public static function getInstance()
    {
        if (isset(static::$_instance)) {
            return static::$_instance;
        }
        return $_instance = new self();

    }

    private function __construct()
    {

    }

    private function __clone()
    {

    }


}



