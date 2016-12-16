<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property integer $product_id
 * @property string $product_name
 * @property integer $created_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'product_id', 'created_at'], 'integer'],
            [['product_id','userid'], 'required'],
            [['username'], 'string', 'max' => 60],
            [['product_name'], 'string', 'max' => 90],
            ['created_at','default', 'value'=>time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户ID',
            'username' => '用户名',
            'product_id' => '产品ID',
            'product_name' => '产品名称',
            'created_at' => '创建于',
        ];
    }
}
