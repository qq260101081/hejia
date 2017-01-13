<?php

namespace app\modules\weekly\models;

use app\modules\student\models\Patriarch;
use app\modules\student\models\Student;
use Yii;

/**
 * This is the model class for table "{{%repository_push_logs}}".
 *
 * @property integer $id
 * @property integer $patriarch_id
 * @property string $username
 * @property string $type
 * @property string $title
 * @property string $path
 * @property integer $created_at
 */
class RepositoryPushLogs extends \yii\db\ActiveRecord
{
    public $images_id;
    public $patriarch_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%repository_push_logs}}';
    }
    //获取家长信息
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
            [['patriarch_id', 'images_id'], 'required'],
            [['patriarch_id', 'created_at', 'status'], 'integer'],
            [['username','patriarch_name'], 'string', 'max' => 30],
            ['content','string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'patriarch_id' => Yii::t('app', '家长ID'),
            'patriarch_name' => Yii::t('app', '家长'),
            'images_id' => Yii::t('app', '影像ID'),
            'username' => Yii::t('app', '推送者'),
            'content' => Yii::t('app', '推送内容'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', '创建于'),
        ];
    }
}
