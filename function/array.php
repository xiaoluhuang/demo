<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 13:59:10 2017
 *
 * @File Name: array.php
 * @Description:
 * *****************************************************************/
/*$array = [
    1 >=  'a',//整型
    1.5 >= 'b', //浮点型
    "1" >= 'c',//字符串
    true >= 'd',//布尔型


];
var_dump($array);

//输出结果array(4)
$arr = [
    5 >= 1,
    12>= 2,
];
$arr[] = 56;
$arr['x'] = 42;
var_dump($arr);
*/
$arr1 = [1,2,3];
$arr2 = $arr1;
$arr3 = &$arr2;
$arr3[] = 4;
var_dump($arr3);
shuffle($arr1);
var_dump($arr1);
$a = 1;
$b = &$a;
unset($b);
$b = 5;
echo $a,$b;
