<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/3 下午12:21
 */
namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%wx_article}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $list_img
 * @property string $info
 * @property string $content
 * @property integer $created_at
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['content'], 'string'],
            [['typename','name'], 'string', 'max' => 90],
            [['list_img'], 'string', 'max' => 150],
            [['info'], 'string', 'max' => 105],
            ['created_at', 'default', 'value' => time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typename' => '产品类型',
            'name' => '产品名称',
            'list_img' => '列表图片',
            'info' => '描述',
            'content' => '内容',
            'created_at' => '创建于',
        ];
    }
}