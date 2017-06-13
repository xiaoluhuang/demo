<?php

$redis = new Redis();
$redis->connect('127.0.0.1','6379');

$keys = $redis->keys('*');
//var_dump($keys);
$redis->set('redis_name', 'huangxiaolu', 3);
$redisName = $redis->get('redis_name');
var_dump($redisName);

sleep(4);

$redisName = $redis->get('redis_name');
var_dump($redisName);
