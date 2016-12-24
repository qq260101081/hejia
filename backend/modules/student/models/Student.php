<?php

namespace app\modules\student\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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
class Student extends Patriarch
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sex', 'age', 'school', 'grade'], 'required'],
            [['age', 'created_at', 'updated_at'], 'integer'],
            [['sex','name'], 'string', 'max' => 12],
            ['remark', 'string', 'max' => 300],
            [['school', 'grade'], 'string', 'max' => 90],
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
            'grade' => Yii::t('app', 'Grade'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
