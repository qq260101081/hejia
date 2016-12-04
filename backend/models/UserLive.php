<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%wx_user_live}}".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $msgid
 * @property integer $status
 * @property integer $created_at
 */
class UserLive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_user_live}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'msgid', 'status', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户ID',
            'msgid' => '消息ID',
            'status' => '状态',
            'created_at' => '创建于',
        ];
    }
}
