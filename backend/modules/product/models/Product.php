<?php

namespace app\modules\product\models;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'content'], 'required'],
            [['category_id', 'created_at','status'], 'integer'],
            [['content','pdf_name'], 'string'],
            [['name', 'info'], 'string', 'max' => 1000],
            [['list_img', 'pro_img'], 'string', 'max' => 90],
            ['created_at', 'default','value' => time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'list_img' => Yii::t('app', 'List Img'),
            'pro_img' => Yii::t('app', 'Pro Img'),
            'pdf_name' => Yii::t('app', 'Pdf name'),
            'info' => Yii::t('app', 'Info'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}