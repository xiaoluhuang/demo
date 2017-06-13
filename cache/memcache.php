<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/4/29
 * Time: 上午11:05
 */

// connect
$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211);


$is_set = $memcache->set('key1', '中华人民共和国', MEMCACHE_COMPRESSED, 0);

// get
$var = $memcache->get('key1');
var_dump($var);


$name = 'huangxiaolu';
$isSet = $memcache->set('name', 'huangxiaolu', MEMCACHE_COMPRESSED, 3);

$var = $memcache->get('name');
var_dump($var);


$var = $memcache->get('name');
var_dump($var);


function square($num)
{
    $memcache = new Memcache;
    $memcache->connect('127.0.0.1', 11211);
    $a = $memcache->get($num);
    if ($a) {
        return $a;
    }
    $square = $num * $num;
    $memcache->set($num, $square);
    return $square;
}

$three = square(3);
$memcache->set('3', $three, MEMCACHE_COMPRESSED, 0);
$cache3 = $memcache->get('3');

/**
 * 3
 * 46
 * 3
 * 45
 * 45
 * 3
 * 45
 * 7
 */
$origin = [
    11, 41, 51, 61, 21, 31, 71, 11, 41, 41,
];
$square = [];
foreach ($origin as $v) {

    $b = $memcache->get($v);
    if ($b) {
        $square[] = $b;
        echo '这是缓存的' . $b, PHP_EOL;

    } else {
        $a = square($v);
        $square[] = $a;
        $memcache->set($v, $a);
//        var_dump($a);
        echo '这是计算的' . $a, PHP_EOL;
    }


}

var_dump($square);

$origin = [
    111, 411, 511, 611, 211, 311, 711, 111, 411, 411,
];

$square = [];
foreach ($origin as $v) {
    $square[] = square($v);
}


echo 'this is from today';

$a = $memcache->add('mood', 'happy',0);
//$b = $memcache->add('mood', 'worse',0);

var_dump($memcache->get('mood'));