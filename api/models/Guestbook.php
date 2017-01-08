<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/3 下午12:21
 */
namespace api\models;

use yii\db\ActiveRecord;

class Guestbook extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guestbook}}';
    }

    public function rules()
    {
        return [
            ['content', 'required'],
            [['created_at','userid'], 'integer'],
            [['content','name'], 'string'],
            ['created_at', 'default', 'value' => time()]
        ];
    }
}