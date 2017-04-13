<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 09:14:52 2017
 *
 * @File Name: replace.php
 * @Description:
 * *****************************************************************/
/*$phrase = "You should eat fruits, vegetables, and fiber every day.";
$healthy = array("fruits", "vegetables", "fiber");
$yummy = array("pizza", "beer", "ice cream");
$a = [1,2,3,4,5,6,7];
$c = shuffle($yummy);
var_dump($yummy);

$newphrase = str_replace($healthy, $yummy, $phrase);
echo $newphrase, PHP_EOL;
$str = str_replace('ll', '*', 'good golly miss molly.', $count);
$str1 = str_ireplace('ll', '%', 'good golly miss molly.');

echo $str, PHP_EOL;
echo $count, PHP_EOL;
echo $str1;
foreach (range(0, 12) as $number) {
    var_dump($number);
}
$array1 = array("color" => "red", 2, 4);
$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4, 3 => 6);
$result = array_merge($array1, $array2);
print_r($result);

$ar1 = array(10, 100, 50, 0);
$ar2 = array(1, 3, 2, 4);
array_multisort($ar2, $ar1);

var_dump($ar1);
var_dump($ar2);*/
$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$rand_keys = array_rand($input, 2);
echo $input[$rand_keys[0]] . "\n";

var_dump($rand_keys);

$array = ['a', 'b', 'c'];
