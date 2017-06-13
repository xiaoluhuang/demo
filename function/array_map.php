<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/24
 * Time: 上午7:38
 */

$a = (string)55;
$b = strval(55);
$c = (int)'adf';
$d = intval('aa');
$e = (bool)'af';
$f = boolval('asd ');
var_dump($a, $b);

$array = ['11', '334', '555'];
$arr = array_map('intval', $array);
var_dump($arr);