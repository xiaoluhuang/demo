<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 17:23:40 2017
 *
 * @File Name: test.php
 * @Description:
 * *****************************************************************/
$a = 1;
var_dump($a);
$array = [1,2,3,4,4];
print $a;
$num = 5;
$location = 'tree';

$format = 'There are %d monkeys in the %s';
echo sprintf($format, $num, $location);
$str = str_ireplace('%body%', 'black', 'body text=%BODY%');
echo $str;
$var1 = "Hello";
$var2 = "hello";
echo strcasecmp($var1, $var2);
echo strcmp($var1, $var2);
echo '------this is a and b----';
$a = 'hello world!';
$b = trim('  hello world! ');
echo $a,PHP_EOL;
echo $b,PHP_EOL;
echo strpos($a, 'l');
echo strpos($b, 'l');
$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211);
echo  phpinfo();
