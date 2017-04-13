<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/14
 * Time: 下午1:21
 */
/*$str1 = '你好!';//中文占三个字节;
echo strlen($str1);
echo mb_strlen($str1);*/
$str = 'abrcelgaf';
$char = 'L';
//echo strpos($str, $char);
//echo strstr($str,$char);
echo stristr($str, $char);
$a = 'i am huangxiaolu love this wolrd!';
$b = '女人, 男人, 女孩, 男孩';
echo str_replace('男', '女', $b);
echo strtr($b, array('女' => '男'));
echo str_replace('o', '*', $a);
$str2 = 'wo shi yi ge da ben dan!';
$array = explode(',', $str2);
var_dump($array);


$c = 'a b c d e f g';
$arr = explode(' ', $c);
foreach ($arr as $k => $v) {
    echo $k, $v, PHP_EOL;
}

$d = 'abcdefg';
//$newd = str_shuffle($d);
//printf($newd);
$newarray = str_split($d);

foreach ($newarray as $k => $v) {
    echo $k, $v;
}


$zongzi = "1|2|3|4|5|6";
$zongzi = explode("|", $zongzi);
var_dump($zongzi);
$zongzi = implode("|", $zongzi);
echo $zongzi;

$array = array('lastname', 'email', 'phone');
$comma_separated = implode(",", $array);
var_dump($comma_separated);

$d{1};