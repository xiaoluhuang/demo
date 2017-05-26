<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/17
 * Time: 上午8:03
 */
// 冒泡排序的两种方式
// 第一种方式
// 从第一个开始,将每个数与左边的进行比较,把最大的数放到最后
function bubble_sort(&$arr)
{
    for ($i = 0, $len = count($arr); $i < $len; $i++) {
        for ($j = 1; $j < $len - $i; $j++) {
            if ($arr[$j - 1] > $arr[$j]) {
                $temp = $arr[$j - 1];
                $arr[$j - 1] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
}

// 测试
$arr = array(10, 2, 36, 14, 10, 25, 23, 85, 99, 45);
bubble_sort($arr);
print_r($arr);


// 第二种方式
// 从最后一个开始比较,选出最小的放在最前面
function bubble(&$array)
{
    for ($i = 0, $len = count($array); $i < $len; $i++) {
        for ($j = $len - 1; $j > $i; $j--) {
            if ($array[$j] < $array[$j-1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j-1];
                $array[$j-1] = $temp;
            }
        }
    }

}


$array = array(10, 2, 36, 14, 10, 25, 23, 85, 99, 45);
bubble($array);
print_r($array);