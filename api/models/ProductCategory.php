<?php

namespace api\models;

use Yii;
use yii\db\ActiveRecord;

class ProductCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%product_category}}';
    }

}
