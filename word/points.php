<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/6/7
 * Time: 下午3:29
 */
// 连接redis
$redis = new Redis();
$redis->connect('127.0.0.1','6379');

// 2015年4月1日 uid 为1的用户积分增加5分
//$redis->zIncrBy('rank:20150401',5,1);
//$redis->zIncrBy('rank:20150401',1,2);
//$redis->zIncrBy('rank:20150401',3,3);
$rank = $redis->zRange('rank:20150401',0,-1,withscores);
$top3  = $redis->zRevRange('rank:20150401',0,2,withscores);
var_dump($rank,$top3);