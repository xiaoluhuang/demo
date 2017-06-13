<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/22
 * Time: 下午10:35
 */

namespace app\modules\controllers;


use yii\web\Controller;
use Yii;
use app\models\Category;


class CategoryController extends Controller
{

    // 分类列表
    public function actionList()
    {
        $model = new Category();
        $this->layout = 'layout1';
        $cates = $model->getTreeList();
        return $this->render('cates', [
            'cates' => $cates,
        ]);

    }

    // 添加分类
    public function actionAdd()
    {
        $model = new Category();
        $this->layout = 'layout1';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }
        $model->title = '';
        $list = $model->getOptions();
        return $this->render('add', [
            'list' => $list,
            'model' => $model,
        ]);
    }

    public function actionDel()
    {
        $model = new Category();
        $this->layout = 'layout1';
        $category_id = Yii::$app->request->get('category_id');
        try {
            if (empty($category_id)) {
                throw new \Exception('获取分类ID错误');
            }
            // 先判断这个分类下是狗有子类,如果有不允许删除
            $data = Category::find()->where('parent_id = :id', [
                ':id' => $category_id,
            ])->one();
            if ($data) {
                throw new \Exception('该分类下有子类,不允许删除');
            }
            if (!$model->deleteAll('category_id = :id',[
                ':id' => $category_id,
            ])) {
                throw new \Exception('删除失败');
            };

        }catch(\Exception $e) {
            Yii::$app->session->setFlash('info',$e->getMessage());
        }
        return $this->redirect(['category/list']);
    }

    public function actionMod()
    {
        $model = new Category();
        $this->layout = 'layout1';
        $list = $model->getOptions();
        $category_id = Yii::$app->request->get('category_id');
        $model = Category::find()->where('category_id = :id', [
            ':id' => $category_id,
        ])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->load($post) && $model->save()) {
            }
        }
        return $this->render('add', [
            'model' => $model,
            'list' => $list,
        ]);
    }
}