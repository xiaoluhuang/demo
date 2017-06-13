<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 17:15:26 2017
 *
 * @File Name: arr.php
 * @Description:
 * *****************************************************************/
$a = array_fill(0,50, 1);
$b = array_fill(0,16, 2);
$c = array_fill(0,2, 3);
$d = array_fill(0,32, 0);
$arr = array_merge($a, $b, $c);
var_dump($arr);
$d = mt_rand(0,99);
echo $arr[$d];




