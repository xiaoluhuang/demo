<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 10:32:24 2017
 *
 * @File Name: bool.php
 * @Description:
 * *****************************************************************/

$a_bool =true;
$a_int = 100;
$a_str = 'foo';
$a_str1 ="foo";

echo gettype($a_bool),PHP_EOL;
echo gettype($a_int),PHP_EOL;
echo gettype($a_str),PHP_EOL;

if(is_bool($a_str1)){
   echo "是布尔型",PHP_EOL;
}
if(is_int($a_int)){
    $a_int+=4;
    echo $a_int,PHP_EOL;
}
settype($a_str1, "integer");
var_dump($a_str1);