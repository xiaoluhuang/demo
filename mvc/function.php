<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/20
 * Time: 下午6:48
 */
function C($name, $method)
{
    require_once 'libs/controller/' . $name . 'Controller.class.php';
    eval('$obj = new' . $name . 'Controller();$obj->' . $method . '();');

}

C('test', 'show');
function M($name)
{
    require_once('/libs/model/' . $name . 'Model.class.php');
    eval('$obj = new' . $name . 'Model();');
    return $obj;
}

function V($name)
{
    require_once('/libs/view/' . $name . 'View.class.php');
    eval('$obj = new' . $name . 'View();');
    return $obj;
}

function daddslashes($str)
{
    return (!get_magic_quotes_gpc() ? addslashes($str) : $str);
}