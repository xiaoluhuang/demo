<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/20
 * Time: 下午5:16
 */
//url形式 index.php?controller=控制器&method=方法名
require_once 'function.php';
$controllerAllow = array('test', 'index','show');
$modelAllow = array('test', 'index');
$controller = in_array($_GET['controller'],
    $controllerAllow) ? addslashes($_GET['controller']) : 'index';
$method = in_array($_GET['method'],
    $modelAllow) ? addslashes($_GET['controller']) : 'model';
//$controller = addcslashes($_GET['controller']);
//$method = addcslashes($_GET['method']);
C($controller, $method);