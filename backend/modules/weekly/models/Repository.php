<?php

namespace app\modules\weekly\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property integer $created_at
 */
class Repository extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%repository}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title','required'],
            [['created_at', 'userid'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 12],
            [['title', 'path'], 'string', 'max' => 150],
            ['created_at', 'default', 'value'=>time()],
            ['path', 'file','maxFiles'=>10, 'extensions' => ['png', 'jpg', 'gif','mp4'], 'maxSize' => 1024 * 1024 * 1000],

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
            'path' => '影像路径',
            'userid' => '上传者ID',
            'name' => '上传者',
            'created_at' => '创建时间',
        ];
    }
}
