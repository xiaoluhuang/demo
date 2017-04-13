<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 22:46:20 2017
 *
 * @File Name: 01.php_base.php
 * @Description:
 * *****************************************************************/

// php基础试题
// ============
// 1、解释 for foreach 相同和不同

for (; 1;) {
    if ($i++ > 3) {
        break;
    } else {
        echo $i * $i;
        continue;
    }

}


// 2、分别用 for foreach 来实现一个把数组里所有值相加
/*$array = [1, 3, 5, 7, 9];

for($i=0,$j=0;$i<count($array);$i++){
    $j+=$array[$i];
}
echo $j,PHP_EOL;
$sum = 0;
// 作用域
// 变量赋值
foreach($array as $k => $v){
    $sum = $sum+$v;
}
echo $sum,PHP_EOL;
*/
// 3、把数组的key和value对调,至少用两种方法
$array = ['color' => 'yellow', 'name' => 'huangxiaolu'];
$array = array_flip($array);
var_dump($array);

$new = [];
foreach ($array as $k => $v) {
    $new[$v] = $k;
}
var_dump($new);


// 4、把数组something里出现color里的颜色的值打印出来,如blue => ocean
$color = ['yellow', 'blue'];
$something = ['white' => 'cloud', 'blue' => 'ocean', 'red' => 'fire'];
list($a, $b) = $color;
foreach ($something as $k => $v) {
    if ($a == $k || $b == $k) {
        print_r($v);
    }
}