<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  5/24 20:04:41 2017
 *
 * @File Name: test.php
 * @Description:
 * *****************************************************************/
$a = 'my name is huangxiaolu';
$b = [1,'wre',45];
function add() {
    echo 'this is add';
    var_dump($a);
    return ture;
}

$c = add();
echo $c;
