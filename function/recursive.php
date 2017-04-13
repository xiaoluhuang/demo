<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/20
 * Time: 下午4:11
 */
function sum($n)
{
    if ($n ==1) {
        return 1;
    }
    return $n + sum($n-1);
}

echo $sum = sum(100);
