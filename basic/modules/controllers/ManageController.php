<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/22
 * Time: 下午2:23
 */

/**
 *  找回密码
 */
namespace app\modules\controllers;

use yii\web\Controller;
use yii;
use app\modules\models\Admin; // 数据库
use yii\data\Pagination; // 分页

class ManageController extends Controller
{
    /**
     *
     *  参数校验,然后修改密码
     */
    public function actionMailchangepass()
    {
        $this->layout = false;
        $time = Yii::$app->request->get('timestamp');
        $admin_user = Yii::$app->request->get('admin_user');
        $token = Yii::$app->request->get('token');
        $model = new Admin();
        $myToken = $model->createToken($admin_user, $time);
        // 验证身份
        if ($token != $myToken) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        // 判断时间是否还有效
        if (time() - $time > 300) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        // 修改密码
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changePass($post)) {
                Yii::$app->session->setFlash('info', '密码修改成功');
            }
        }
        $model->admin_user = $admin_user;
        return $this->render('mailchangepass', [
            'model' => $model,
        ]);


    }

    // 管理员列表
    public function actionManagers()
    {
        $this->layout = 'layout1';
//        $managers = Admin::find()->all();
        // 分页
        // 在config/params里面修改pageSize的值
        $paseSize = Yii::$app->params['pageSize']['manage'];
        $model = Admin::find();
        $count = $model->count();
        $pager = new Pagination([
            'totalCount' => $count,
            'pageSize' => $paseSize,
        ]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('managers', [
            'managers' => $managers,
            'pager' => $pager,
        ]);
    }

    // 添加管理员
    public function actionReg()
    {
        $this->layout = 'layout1';
        $model = new Admin();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');

            }
        }
        $model->admin_passwd = '';
        $model->repass = '';
        return $this->render('reg', [
            'model' => $model,
        ]);
    }

    // 删除管理员
    public function actionDel()
    {
        $admin_id = (int)Yii::$app->request->get('admin_id');
        if (empty($admin_id)) {
            $this->redirect(['manage/managers']);
        }
        $model = new Admin();
        // 删除
        if ($model->deleteAll('admin_id = :id',[
            ':id' => $admin_id,
        ])) {
            Yii::$app->session->setFlash('info','删除成功');
            $this->redirect(['manage/managers']);
        }
    }

    // 修改管理员邮箱

    public function actionChangeemail()
    {
        $this->layout = 'layout1';
        $model = new Admin();
        $modelQuery = Admin::find()->where('admin_user=:user',[
            ':user' => Yii::$app->session['admin']['admin_user'],
        ])->one();
       if (Yii::$app->request->isPost) {
           $post = Yii::$app->request->post();
           if ($model->changeemail($post)) {
                Yii::$app->session->setFlash('info','修改成功');
           }
       }
       $model->admin_passwd = '';
        return $this->render('changeEmail',[
            'model' => $modelQuery,
        ]);
    }

    public function actionChangepass()
    {

        $this->layout = 'layout1';
        $model = new Admin();
        $modelQuery = Admin::find()->where('admin_user=:user',[
            ':user' => Yii::$app->session['admin']['admin_user'],
        ])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changePass($post)) {
                Yii::$app->session->setFlash('info','修改成功');
            }
        }
        $model->admin_passwd = '';
        $model->repass = '';
        return $this->render('changepass',[
            'model' => $modelQuery,
        ]);
    }


}
