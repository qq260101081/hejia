<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 下午8:40
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class NewsCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }
}