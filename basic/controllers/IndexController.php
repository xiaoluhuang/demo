<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/11
 * Time: 下午6:57
 */

namespace app\controllers;

use yii\web\Controller;
use app\controllers\CommonController;

class IndexController extends CommonController
{
    public $layout = false; // layout是成员变量

    public function actionIndex()
    {
//        $this->layout = false;
        $this->layout = ('layout1');
        return $this->render('index');
    }
}