<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 日  3/19 11:11:47 2017
 *
 * @File Name: Singleton.php
 * @Description:
 * *****************************************************************/

/**
 * 整个进程里只有一个实例,保证对象的一致性,减少资源消耗
 * Class Singleton
 */
class Singleton {

    private $name;

    // 私有的静态属性
    private static $_instance;

    // 静态方法获取该对象
    public static function getInstance() {
        // 2,3,4
        if (isset(static::$_instance)) {
            return static::$_instance;
        }

        // 1
        static::$_instance = new static();

        return static::$_instance;
    }

    // 防止被new
    private function __construct() {
        echo __METHOD__, PHP_EOL;
    }


    // 防止被clone
    private function __clone() {
        // TODO: Implement __clone() method.
    }

    // 测试 say 方法
    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        echo __METHOD__ . " name = {$this->name}", PHP_EOL;
    }
}

// 调用
//$singleton = new Singleton();
// 获得对象
$singleton = Singleton::getInstance();
$q = Singleton::getInstance();
// 用该对象来调用方法
$singleton->setName('huangxiaolu');
$singleton->getName();
$q->getName();
$q->setName('wushuiyong');
$q->getName();
$singleton->getName();

