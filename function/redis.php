<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/20
 * Time: 上午11:58
 */
$redis = new Redis();

$redis->connect('127.0.0.1', 6379);
$arr = array('h', 'e', 'l', 'l', 'o', 'w', 'o', 'r', 'l', 'd');

foreach ($arr as $k => $v) {

    $redis->rpush("mylist", $v);

}

$value = $redis->lpop('mylist');

if ($value) {

    echo "出队的值" . $value;

} else {

    echo "出队完成";

}
