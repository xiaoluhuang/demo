<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 四  4/20 23:17:03 2017
 *
 * @File Name: a.php
 * @Description:
 * *****************************************************************/
session_start();
$_SESSION[$_GET['k']] = $_GET['v'];
var_dump($_SESSION);
