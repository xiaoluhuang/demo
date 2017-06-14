<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/6/13
 * Time: 下午12:10
 */
// 冒泡排序
// 主要思想,将第一数与后面一个数依次进行比较,小的往前排
function bubble_sort($arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 1; $j < count($arr) - $i; $j++) {
            if ($arr[$j-1] > $arr[$j]) {
                $tmp = $arr[$j-1];
                $arr[$j-1] = $arr[$j];
                $arr[$j] = $tmp;
            }

        }
    }
    return $arr;
}

function bubble_sort1(&$arr){
    for ($i=0,$len=count($arr); $i < $len; $i++) {
        for ($j=1; $j < $len-$i; $j++) {
            if ($arr[$j-1] > $arr[$j]) {
                $temp = $arr[$j-1];
                $arr[$j-1] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
}

$arr = [1, 44, 2, 55, 33, 23, 6, 19, 72, 12, 35, 1];

$a = bubble_sort($arr);
print_r($a);