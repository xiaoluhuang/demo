<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/24
 * Time: 下午3:07
 */

namespace app\modules\controllers;


use yii\web\Controller;
use app\models\Product;
use app\models\Category;
use yii;
use yii\data\Pagination;
use crazyfd\qiniu\Qiniu;


class ProductController extends Controller
{
    public function actionList()
    {
        $model = Product::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['product'];
        $pager = new Pagination([
            'totalCount' => $count,
            'pageSize' => $pageSize
        ]);
        $products = $model->offset($pager->offset)
            ->limit($pager->limit)->all();
        $this->layout = "layout1";
        return $this->render("products", [
            'products' => $products,
            'pager' => $pager
        ]);
    }

    public function actionAdd()
    {
        $this->layout = "layout1";
        $model = new Product;
        $cate = new Category;
        $list = $cate->getOptions();
        unset($list[0]);

        // 提交的时候判断是否有图片
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $pics = $this->upload();
            if (!$pics) {
                $model->addError('cover', '封面不能为空');
            } else {
                $post['Product']['cover'] = $pics['cover'];
                $post['Product']['pics'] = $pics['pics'];
            }
            if ($pics && $model->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }
        return $this->render("add", [
            'opts' => $list,
            'model' => $model
        ]);

    }

    // 图片上传
    private function upload()
    {
        if ($_FILES['Product']['error']['cover'] > 0) {
            return false;
        }

        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $key = uniqid();
        $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
        $cover = $qiniu->getLink($key);
        $pics = [];
        foreach ($_FILES['Product']['tmp_name']['pics'] as $k => $file) {
            if ($_FILES['Product']['error']['pics'][$k] > 0) {
                continue;
            }
            $key = uniqid();
            $qiniu->uploadFile($file, $key);
            $pics[$key] = $qiniu->getLink($key);
        }
        return [
            'cover' => $cover,
            'pics' => json_encode($pics)
        ];
    }

    // 修改商品信息

    public function actionMod()
    {
        $this->layout = 'layout1';
        // 获取商品列表
        $cate = new Category();
        $list = $cate->getOptions();
        // 取点list的第一个元素-添加顶级分类
        array_shift($list);
        // 获取传递过来的product_id
        $product_id = Yii::$app->request->get('product_id');
        // 根据id,从数据库获取相应的产品信息
        $model = Product::find()->where('product_id = :id', [
            ':id' => $product_id,
        ])->one();
        // 做修改,其实和添加商品一下,也是从前端获取post数据,在数据库里更新
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
            $post['Product']['cover'] = $model->cover;
            if ($_FILES['Product']['error']['cover'] == 0) {
                $key = uniqid();
                $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
                $qiniu->delete(basename($model->cover));
            }
            $pics = [];
            foreach ($_FILES['Product']['tmp_name']['pics'] as $k => $file) {
                if ($_FILES['Product']['error']['pics'][$k] > 0) {
                    continue;
                }
                $key = uniqid();
                $qiniu->uploadFile($file, $key);
                $pics[$key] = $qiniu->getLink($key);
            }
            $post['Product']['pics'] = json_encode(array_merge((array)json_decode($model->pics, true), $pics));
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('info', '修改成功');
            }
        }
        // 将数据传递给前端页面
        return $this->render('add', [
            'model' => $model,
            'opts' => $list,
        ]);
    }

    // 删除图片
    public function actionRemovepic()
    {
        $key = Yii::$app->request->get('key');
        $product_id = Yii::$app->request->get('product_id');
        $model = Product::find()->where('product_id = :id', [
            ':id' => $product_id,
        ])->one();
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete($key);
        $pics = json_decode($model->pics, true);
        unset($pics[$key]);
        Product::updateAll(['pics' => json_encode($pics)], 'product_id = :pid', [':pid' => $product_id]);
        return $this->redirect(['product/mod', 'product_id' => $product_id]);

    }

    // 删除商品

    public function actionDel()
    {
        $product_id = Yii::$app->request->get('product_id');
        // 根据id,从数据库获取相应的产品信息
        $model = Product::find()->where('product_id = :id', [
            ':id' => $product_id,
        ])->one();
        $key = basename($model->cover);
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete($key);
        $pics = json_decode($model->pics, true);
        foreach ($pics as $key => $file) {
            $qiniu->delete($key);
        }
        Product::deleteAll('product_id=:pid', [
            'pid' => $product_id,
        ]);
        return $this->redirect(['product/list']);
    }

    // 商品上架
    public function actionOn()
    {
        $product_id = Yii::$app->request->get('product_id');
        Product::updateAll(['is_on' => '1'], 'product_id = :pid', [
            ':pid' => $product_id,
        ]);
        return $this->redirect(['product/list']);
    }

    public function actionOff()
    {
        $product_id = Yii::$app->request->get('product_id');
        Product::updateAll(['is_on' => '0'], 'product_id = :pid', [
            ':pid' => $product_id,
        ]);
        return $this->redirect(['product/list']);
    }
}
