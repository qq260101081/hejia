<?php

namespace app\modules\weekly\models;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%repository_push_logs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patriarch_id', 'images_id'], 'required'],
            [['patriarch_id', 'created_at', 'status'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['type'], 'string', 'max' => 10],
            [['title', 'path'], 'string', 'max' => 150],
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
            'images_id' => Yii::t('app', '影像ID'),
            'username' => Yii::t('app', '推送者'),
            'type' => Yii::t('app', '类型'),
            'title' => Yii::t('app', '标题'),
            'path' => Yii::t('app', '资源路径'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', '创建于'),
        ];
    }
}
