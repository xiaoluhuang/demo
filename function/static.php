<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 16:12:18 2017
 *
 * @File Name: static.php
 * @Description:
 * *****************************************************************/

//写一个函数让变量的值增加到10;
function test()
{
    static $count = 0;
    $count++;
    var_dump( $count);
    if($count < 10){
        test();

    }

}
test();

