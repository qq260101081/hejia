<?php

namespace app\modules\serviceProduct\models;

use Yii;

/**
 * This is the model class for table "{{%service_product}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $info
 * @property integer $created_at
 */
class ServiceProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type','info'], 'required'],
            [['type','created_at'], 'integer'],
            [['name'], 'string', 'max' => 90],
            [['info'], 'string', 'max' => 600],
            ['created_at', 'default', 'value' => time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'type' => Yii::t('app', '类型'),
            'info' => Yii::t('app', '描述'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
