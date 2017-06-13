<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/11
 * Time: 下午6:57
 */

namespace app\controllers;

use yii\web\Controller;

class MemberController extends Controller
{
    public $layout = false; // layout是成员变量

    public function actionAuth()
    {
        $this->layout = ('layout2');
        return $this->render('auth');
    }
}