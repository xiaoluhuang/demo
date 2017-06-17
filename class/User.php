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

    /**
     * 成员变量,子类可以继承使用
     * @var
     */
    protected $gender;


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
    }

    /**
     * 成员方法
     * @param $song
     */
    public function sing($song)
    {
        echo "$this->name can  sing a song: $song, thank you\n";
    }

    /**
     * 成员方法
     * @param $song
     */
    public function dance($dance)
    {
        echo "$this->name can $dance\n";
    }

    /**
     * 成员方法
     * @param $song
     */
    public function cooking($dance)
    {
        echo "$this->name can $dance\n";
    }

}
