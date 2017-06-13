<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/5/22
 * Time: 下午10:47
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Category extends ActiveRecord
{
    public static function tablename()
    {

        return 'shop_category';
    }

    public function rules()
    {
        return [
            ['parent_id', 'required', 'message' => '上级分类不能为空'],
            ['title', 'required', 'message' => '标题名称不能为空'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'parent_id' => '上级分类',
            'title' => '分类名称',
        ];
    }

    // 添加分类
    public function add($post)
    {
        $post['Category']['created_at'] = time();
        // insert 添加
        if ($this->load($post) && $this->save()) {
            return true;
        }
        return false;
    }

    // 查询分类
    public function getData()
    {
        $cates = self::find()->all();
        $cates = ArrayHelper::toArray($cates);
        return $cates;

    }

    public function getTree($cates, $parent_id = 0)
    {
        $tree = [];
        foreach ($cates as $cate) {
            if ($cate['parent_id'] == $parent_id) {
                $tree[] = $cate;
                $tree = array_merge($tree, $this->getTree($cates, $cate['category_id']));
            }
        }
        return $tree;
    }

    // 加前缀
    // 找到一个级别,把它应该有的前缀放到一个数组里,$prefix
    public function setPrefix($data, $p = "----")
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while ($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if ($data[$key - 1]['parent_id'] != $val['parent_id']) {
                    $num++;
                }
            }
            if (array_key_exists($val['parent_id'], $prefix)) {
                $num = $prefix[$val['parent_id']];
            }
            $val['title'] = str_repeat($p, $num) . $val['title'];
            $prefix[$val['parent_id']] = $num;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }


    // 关联数组
    public function getOptions()
    {
        $tree = $this->getTreeList();
        $options = ['添加顶级分类'];
        foreach ($tree as $cate) {
            $options[$cate['category_id']] = $cate['title'];
        }
        return $options;
    }

    public function getTreeList()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        return $tree;
    }
}