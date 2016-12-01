<?php

namespace app\modules\pages\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $code_id
 * @property integer $content
 * @property integer $created_at
 * @property integer $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }
    public function behaviors()
    {
    	return [
    		[
    			'class' => TimestampBehavior::className(),
    			'createdAtAttribute' => 'created_at',
    			'updatedAtAttribute' => 'updated_at',
    			'value' => time(),
    		],
    	];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code_id','content'], 'required'],
            [[ 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 120],
            [['code_id'], 'string', 'max' => 30],
            //[['code_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'code_id' => Yii::t('app', '类型'),
            'content' => Yii::t('app', '内容'),
            'created_at' => Yii::t('app', '创建于'),
            'updated_at' => Yii::t('app', '更新于'),
        ];
    }
}
