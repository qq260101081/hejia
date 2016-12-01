<?php

namespace app\modules\presscentre\models;

use Yii;

class NewsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }
}
