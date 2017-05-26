<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/26
 * Time: 下午4:34
 */
$stack = array("orange", "banana", "apple", "raspberry");
$fruit = array_shift($stack);
$a = array_pop($stack);
print_r($stack);
print_r($a);
print_r($fruit);
