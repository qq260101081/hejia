<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:30
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Mien extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%Mien}}';
    }
}