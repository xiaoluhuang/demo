<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 日  3/12 23:45:43 2017
 *
 * @File Name: foreach.php
 * @Description:
 * *****************************************************************/

$array = [
'array_1' => ['name' => 'huangxiaolu', 'sex' => 'very sexy',],
'array_2' => ['name' => 'wushuiyong', 'sex' => 'old man',],
];
#var_dump($array);

/*
echo PHP_EOL, $array[0]['name'], PHP_EOL, $array[1]['name'], PHP_EOL;
// 1 for
for ( $i = 0; $i < count($array); $i++) {
    echo $array[$i]['name'], PHP_EOL;
}

// 2 foreach
foreach ($array as $key => $value) {
    #var_dump($key, $value);
    var_dump($value['name']);
}
*/

$array = [
['name' => 'huangxiaolu', 'sex' => 'very sexy',],
['name' => 'wushuiyong', 'sex' => 'old man',],
];
foreach ($array as $key => $value) {
    var_dump($key, $value);
}


