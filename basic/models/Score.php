<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/6/8
 * Time: 下午6:06
 */

namespace app\models;

use yii\db\ActiveRecord;


class Score extends ActiveRecord
{
    public static function tablename()
    {

        return 'shop_score';
    }
}