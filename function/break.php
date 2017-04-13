<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 15:08:23 2017
 *
 * @File Name: break.php
 * @Description:
 * *****************************************************************/
$arr = array('one','two','three','four','stop','five');
while(list(,$val)=each($arr)){
    if($val=='stop'){
        break;
    }
echo $val,PHP_EOL;
}
$i=0;
while(++$i){
    switch($i){
        case 5:
      echo '5',PHP_EOL;
            break 1;
        case 10:
            echo '10',PHP_EOL;
        default:
            break;
    }
}
