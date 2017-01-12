<?php

namespace app\modules\msg\models;

use app\modules\student\models\Patriarch;
use Yii;

/**
 * This is the model class for table "{{%msg_push_logs}}".
 *
 * @property integer $id
 * @property integer $patriarch_id
 * @property string $patriarch_name
 * @property string $username
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 */
class MsgPushLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%msg_push_logs}}';
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
            ['title', 'required'],
            [['status', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['username'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 150],
            ['patriarch_id', 'safe'],
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
            'username' => Yii::t('app', '推送人'),
            'title' => Yii::t('app', '标题'),
            'content' => Yii::t('app', '内容'),
            'status' => Yii::t('app', '状态'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
