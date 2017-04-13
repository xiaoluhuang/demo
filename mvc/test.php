<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/20
 * Time: 下午4:53
 *
 * 浏览者->调用控制器，发出指令
 * 控制器->按指令选出一个合适的模型
 * 模型->按控制器指令取出相应的数据
 * 控制器->按指令选取相应视图
 * 视图-> 把取出的数据按照用户想要的样子显示出来
 *
 * */
require_once 'libs/controller/testController.class.php';
require_once 'libs/view/testView.class.php';
require_once 'libs/model/testModel.class.php';
$testController = new testController();
$testController->show();


