<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 14:25:41 2017
 *
 * @File Name: object.php
 * @Description:
 * *****************************************************************/

//对象调用一个方法，用new新建一个对象，方法写在类里面，用类封装方法；
class foo
{
    function do_foo()
    {
        echo 'doing foo.',PHP_EOL;
    }
}

$bar = new foo;
$bar -> do_foo();

$obj = (object) 'ciao';
echo $obj -> scalar,PHP_EOL;//这段不是很懂;