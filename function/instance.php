<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  3/ 8 17:25:31 2017
 *
 * @File Name: instance.php
 * @Description:
 * *****************************************************************/

//用instanceof确定某一变量是不是继承至某一父类
class parentclass
{

}

class myclass extends parentclass
{

}

$a = new myclass();

var_dump($a instanceof myclass);
var_dump($a instanceof parentclass);