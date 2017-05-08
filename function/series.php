<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 日  4/30 11:16:27 2017
 *
 * @File Name: series.php
 * @Description:
 * *****************************************************************/
$array = ['huang', 1, 4, 5, 'hahaha'];
$str = serialize($array);
var_dump($str);
$arr = unserialize($str);
var_dump($arr);
