<?php

/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 二  3/14 23:01:49 2017
 *
 * @File Name: User.php
 * @Description:
 * *****************************************************************/

class User
{
    /**
     * 成员变量,子类可以继承使用
     * @var
     */
    protected $name;
    protected $age;
    /**
     * 构造函数
     * User初始化时,会执行这个函数
     *
     * User constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * 成员方法
     * @param $song
     */
    public function sing($song)
    {
        echo "$this->name is $this->age and can  sing a song: $song\n";
    }

    /**
     * 成员方法
     * @param $song
     */
    public function dance($dance)
    {
        echo "$this->name can $dance\n";
    }

}
