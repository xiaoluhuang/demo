
<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/24
 * Time: 下午1:48
 */
$array = [
    'name' => 'huangxiaolu',
    'age' =>  18,
];

$arr = array_change_key_case($array,CASE_UPPER);
var_dump($arr);