<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 15:32:00 2017
 *
 * @File Name: global.php
 * @Description:
 * *****************************************************************/

$a = 1;
$b = 2;
function test()
{
    global $a, $b;
    $b = $a + $b;

}

test();
echo $b, PHP_EOL;