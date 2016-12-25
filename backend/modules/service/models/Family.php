<?php

namespace backend\modules\service\models;

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
class Family extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_family}}';
    }

    public function getCategoryName()
    {
        return $this->hasOne(ServiceCategory::className(), ['id' => 'category_id']);
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
            [[ 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 120],
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
            'category_id' => Yii::t('app', 'Category ID'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
