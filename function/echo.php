<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/24
 * Time: 下午7:22
 */

$a=array('1','2','3');
$b=&$a;
$a=array('a','b','c');
print_r($a);
print_r($b);