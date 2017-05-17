<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/10
 * Time: 下午2:53
 */
$str = ';whatever he is, i wanna be the best person in the world! "';
$a = trim($str,';');
$b =  trim($a,'"');
echo ucwords($b);

