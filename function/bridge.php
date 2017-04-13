<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/13
 * Time: 下午5:03
 */
//过桥问题,我看不出来这个有什么问题
for ($i = 100000, $int = 0; $i > 5000;) {
    $int++;
    if ($i > 50000) {
        $i *= 0.95;
    } else {
        $i -= 5000;
    }

    echo $int, PHP_EOL;
}

