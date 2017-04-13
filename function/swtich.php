<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 15:31:44 2017
 *
 * @File Name: swtich.php
 * @Description:
 * *****************************************************************/
$i = 6;
switch($i):
case 0:
case 1:echo '值为1',PHP_EOL;
case 6: echo '值为6',PHP_EOL; break;
default:  echo "i is not equal to 0, 1 or 2",PHP_EOL;
    endswitch;
