<?php

namespace app\modules\student\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%student}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property integer $age
 * @property string $school
 * @property string $grade
 * @property integer $created_at
 * @property integer $updated_at
 */
class Student extends ActiveRecord
{
    public function behaviors()
    {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',// 自己根据数据库字段修改
                'updatedAtAttribute' => 'updated_at', // 自己根据数据库字段修改
                'value' => time(), // 自己根据数据库字段修改
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%student}}';
    }

    //获取家长
    public function getPatriarch()
    {
        return $this->hasOne(Patriarch::className(), ['id' => 'patriarch_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sex', 'age', 'school', 'grade', 'category_id'], 'required'],
            [['age', 'created_at', 'updated_at', 'category_id', 'patriarch_id'], 'integer'],
            [['sex','name'], 'string', 'max' => 12],
            ['remark', 'string', 'max' => 300],
            [['school', 'grade'], 'string', 'max' => 90],
            ['category_id', 'default', 'value' => 0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Student Name'),
            'sex' => Yii::t('app', 'Sex'),
            'age' => Yii::t('app', 'Age'),
            'remark' => Yii::t('app', '备注'),
            'school' => Yii::t('app', 'School'),
            'category_id' => Yii::t('app', '所属校区'),
            'grade' => Yii::t('app', 'Grade'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
