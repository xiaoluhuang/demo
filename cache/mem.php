<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/27
 * Time: 下午2:41
 */
$mem = new Memcache();
$mem->connect('127.0.0.1', 11211);
$mem->set('mood', 'happy',MEMCACHE_COMPRESSED,0);
$mood  = $mem->get('mood');
echo $mood;