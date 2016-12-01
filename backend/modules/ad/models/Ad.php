<?php
/**
 * User: 260101081@qq.com
 * Date: 16/10/17 下午1:57
 */
namespace app\modules\ad\models;

use Yii;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $path
 * @property integer $created_at
 */
class Ad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'path'], 'required'],
            [['created_at'], 'integer'],
            [['title', 'path'], 'string', 'max' => 120],
            [['url'], 'string', 'max' => 200],
            ['created_at','default','value' => time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'url' => Yii::t('app', '链接'),
            'path' => Yii::t('app', '图片'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}