<?php

namespace app\modules\student\models;

use Yii;

/**
 * This is the model class for table "{{%student_weekly}}".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $discipline
 * @property integer $sleep
 * @property integer $diet
 * @property integer $study
 * @property integer $synthesize
 * @property integer $created_at
 */
class Weekly extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%student_weekly}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'discipline', 'sleep', 'diet', 'study', 'synthesize','student_name'], 'required'],
            [['student_id', 'discipline', 'sleep', 'diet', 'study', 'created_at'], 'integer'],
            ['student_name', 'string', 'max'=>12],
            ['synthesize', 'string', 'max'=>300],
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
            'student_id' => Yii::t('app', '学生ID'),
            'student_name' => Yii::t('app', '学生姓名'),
            'discipline' => Yii::t('app', '纪律'),
            'sleep' => Yii::t('app', '睡眠'),
            'diet' => Yii::t('app', '饮食'),
            'study' => Yii::t('app', '学习'),
            'synthesize' => Yii::t('app', '综合评定'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
