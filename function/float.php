<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 11:19:51 2017
 *
 * @File Name: float.php
 * @Description:
 * *****************************************************************/
$a = 1.234567;
$b = 1.234560;
if(abs($a-$b)< 0.00001){
    echo "$a=$b";//这里放双引号和单引号输出结果不一样;
}