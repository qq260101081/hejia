<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $list_img
 * @property string $pro_img
 * @property string $info
 * @property string $content
 * @property string $status
 * @property integer $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $category3_id;
    public $category2_id;
    public static function tableName()
    {
        return '{{%product}}';
    }
}