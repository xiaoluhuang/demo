<?php
namespace app\models;

use yii\db\ActiveRecord;


class Product extends ActiveRecord
{
    const AK = 'toix9okVaTB0uz6oxPe_vTnW-psg62jGuQOb01uZ';
    const SK = '9BbqEK8nmW-LlLWnmt4Aqe3CWWKN-IiSJMDlY0a3';
    const DOMAIN = 'o7zgluxwg.bkt.clouddn.com';
    const BUCKET = 'imooc-shop';
    public $cate;
    public function rules()
    {
        return [
            ['title', 'required', 'message' => '标题不能为空'],
            ['descr', 'required', 'message' => '描述不能为空'],
            ['category_id', 'required', 'message' => '分类不能为空'],
            ['price', 'required', 'message' => '单价不能为空'],
            [['price','sales_price'], 'number', 'min' => 0.01, 'message' => '价格必须是数字'],
            ['num', 'integer', 'min' => 0, 'message' => '库存必须是数字'],
            [['is_sale','is_hot', 'pics', 'is_tui'],'safe'],
            [['cover'], 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'category_id' => '分类名称',
            'title'  => '商品名称',
            'descr'  => '商品描述',
            'price'  => '商品价格',
            'is_hot'  => '是否热卖',
            'is_sale' => '是否促销',
            'sales_price' => '促销价格',
            'num'    => '库存',
            'cover'  => '图片封面',
            'pics'   => '商品图片',
            'is_on'   => '是否上架',
            'is_tui'   => '是否推荐',
        ];
    }
    public static function tableName()
    {
        return "shop_product";
    }
    public function add($data)
    {
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }
}