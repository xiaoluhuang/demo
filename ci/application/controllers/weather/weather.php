<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/8
 * Time: 下午9:10
 */
header('Content-type:text/html;charset=utf-8');
include 'weatherApi.php';

//接口基本信息配置

$weather = new weatherApi();
$weather->getWeather($a);