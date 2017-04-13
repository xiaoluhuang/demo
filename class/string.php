<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 二  3/14 23:45:56 2017
 *
 * @File Name: string.php
 * @Description:
 * *****************************************************************/
$string = 'abcdefg';
#echo $string{0};
for ($i = 0; $i < strlen($string); $i++) {
    #echo $i+1, $string{$i};
    echo $i+1, substr($string, $i, 1);
}
echo PHP_EOL;
