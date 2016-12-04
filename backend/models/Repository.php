<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/3 下午12:22
 */
namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%wx_repository}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $path
 * @property integer $created_at
 */
class Repository extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_repository}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['title', 'path'], 'string', 'max' => 150],
            ['created_at', 'default', 'value'=>time()],
            ['path', 'file', 'extensions' => ['png', 'jpg', 'gif','mp4'], 'maxSize' => 1024 * 1024 * 1000],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'title' => '标题',
            'path' => '资源路径',
            'created_at' => '创建于',
        ];
    }
}