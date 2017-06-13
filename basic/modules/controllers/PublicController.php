<?php

namespace app\modules\controllers;

use yii\web\Controller;
use app\modules\models\Admin;
use Yii;

/**
 * Default controller for the `admin` module
 */
class PublicController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    /**
     * @return string
     *  登录,获取表单post数据,如果正确,跳转到后台首页
     *  登录优化:判断是否已经登录,如果已经登录,直接进入首页
     */
    public function actionLogin()
    {
        // 写一个原生的session,判断logout时,session是否被清除
//        session_start();
//        var_dump($_SESSION);
        $this->layout = false;
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                $this->redirect(['default/index']);
                Yii::$app->end();
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    /**
     *  登出操作,在view页面连接地址,清除session
     */
    public function actionLogout()
    {
        // 清除session
        Yii::$app->session->removeAll();

        // 判断session是否被清除,清除了,就跳转到登录页面;如果没有清除,返回原来所在页面;
        if (!isset(Yii::$app->session['admin']['isLogin'])) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        $this->goBack();
    }

    /**
     *  找回密码
     *  需要填写用户名,和邮件,所以需要加载一个模板
     */
    public function actionSeekpassword()
    {

        $model = new Admin;
        $this->layout = false;
        // 判断是否有post数据提交,如果有,判断是否和数据库一致,
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model ->seekPass($post)) {
                Yii::$app->session->setFlash('info','电子邮件已经发送,请查收');
            }
            // 一致的话,做一个发送电子邮件
        }
        return $this->render('seekpassword', ['model' => $model]);
    }

}
