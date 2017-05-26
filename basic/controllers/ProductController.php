<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/11
 * Time: 下午6:57
 */

namespace app\controllers;

use yii\web\Controller;

class ProductController extends Controller
{
    public $layout = false;

    public function actionIndex()
    {
        $this->layout = ('layout2');
        return $this->render('index');
    }

    public function actionDetail()
    {
        $this->layout = ('layout2');
        return $this->render('detail');
    }
}