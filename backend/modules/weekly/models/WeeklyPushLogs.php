<?php

namespace app\modules\weekly\models;

use Yii;

/**
 * This is the model class for table "{{%weekly_push_logs}}".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $student_name
 * @property integer $discipline
 * @property integer $sleep
 * @property integer $diet
 * @property integer $study
 * @property string $synthesize
 * @property string $username
 * @property integer $status
 * @property integer $created_at
 */
class WeeklyPushLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $weekly_name;
    public $weekly_id;
    public static function tableName()
    {
        return '{{%weekly_push_logs}}';
    }

    public function getHiddenFormTokenField() {
        $token = \Yii::$app->getSecurity()->generateRandomString();
        $token = str_replace('+', '.', base64_encode($token));

        \Yii::$app->session->set(\Yii::$app->params['form_token_param'], $token);;
        return Html::hiddenInput(\Yii::$app->params['form_token_param'], $token);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weekly_name'], 'required'],
            [['student_id', 'stime','etime','discipline', 'sleep', 'diet', 'study', 'status', 'created_at'], 'integer'],
            [['student_name'], 'string', 'max' => 12],
            [['synthesize','weekly_name'], 'string', 'max' => 600],
            [['username'], 'string', 'max' => 30],
            ['images', 'string'],
            ['images', 'file','maxFiles'=>10, 'extensions' => ['png', 'jpg','jpeg', 'gif','mp4'], 'maxSize' => 1024 * 1024 * 2000],
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
            'weekly_name' => Yii::t('app', '周报名称'),
            'discipline' => Yii::t('app', '纪律'),
            'sleep' => Yii::t('app', '睡眠'),
            'diet' => Yii::t('app', '饮食'),
            'study' => Yii::t('app', '学习'),
            'synthesize' => Yii::t('app', '综合评定'),
            'images' => Yii::t('app', '影像'),
            'username' => Yii::t('app', '推送者'),
            'status' => Yii::t('app', '状态0未读1已读2删除'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
