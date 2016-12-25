<?php

namespace backend\modules\service\models;
/*
*托辅服务
*/
use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $category_id
 * @property integer $content
 * @property integer $created_at
 * @property integer $updated_at
 */
class Auxiliary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_auxiliary}}';
    }

    public function getCategoryName()
    {
        return $this->hasOne(ServiceCategory::className(), ['id' => 'category_id'])->select(['id','name']);
    }

    public function getCategoryPath($category_id)
    {

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
            [['category_id','content','title'], 'required'],
            [['created_at', 'updated_at','type'], 'integer'],
            [['title','list_img'], 'string', 'max' => 120],
            ['info', 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'list_img' => Yii::t('app', 'List Img'),
            'info' => Yii::t('app', 'Info'),
            'type' => Yii::t('app', 'Type'),
            'category_id' => Yii::t('app', 'Category ID'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
