<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 日  4/16 15:46:16 2017
 *
 * @File Name: class_exists.php
 * @Description:
 * *****************************************************************/
$classes = ['Model', 'Helper', 'Mysqli',];
var_dump(in_array('Mysqli', $classes));
var_dump(class_exists('Mysqli', $autoload = false));
require_once('Mysqli.php');
