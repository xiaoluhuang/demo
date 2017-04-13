<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 13:46:17 2017
 *
 * @File Name: for.php
 * @Description:
 * *****************************************************************/
$people = Array(
         Array('name' => 'Kalle', 'salt' => 856412), 
        Array('name' => 'Pierre', 'salt' => 215863)
    );
for($i=0,$size=count($people);$i<$size;++$i){
    $people[$i]['salt']=rand(000000,999999);
    var_dump($people);
}
