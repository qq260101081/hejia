<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/3 下午12:21
 */
namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%wx_article}}".
 *
 * @property integer $id
 * @property integer $typename
 * @property string $name
 * @property string $list_img
 * @property string $info
 * @property string $content
 * @property integer $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_product}}';
    }
}