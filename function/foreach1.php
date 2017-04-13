<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 14:52:13 2017
 *
 * @File Name: foreach1.php
 * @Description:
 * *****************************************************************/
$arr = array('one','two','three');
reset($arr);
foreach($arr as $value){
    echo 'value:$value',PHP_EOL;
        }
           
