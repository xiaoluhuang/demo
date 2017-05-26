<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/24
 * Time: 上午7:48
 */
$array = ['   adf   ', 'sdf ', ' "   sdf ', ' aff nnn\'',];

function myTrim($value) {

    $value = trim($value, ' ');
    $value = trim($value, '" ');
    $value = trim($value, '\'');


    return $value;
}

$a = array_map('myTrim', $array);
var_dump($a);