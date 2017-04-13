<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 二  3/14 23:05:25 2017
 *
 * @File Name: demo.php
 * @Description:
 * *****************************************************************/
require_once 'User.php';
$name = 'huangxiaolu';
$song = 'mary you';
$dance = 'lollipop';

$user = new User('huangxiaolu');
$user->sing($song);
$user->dance($dance);


