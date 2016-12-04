<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/3 下午12:18
 */
namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%wx_teacher}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age
 * @property integer $working_age
 * @property string $headimg
 * @property string $phone
 * @property integer $created_at
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_teacher}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age', 'working_age', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['headimg'], 'string', 'max' => 150],
            [['phone'], 'string', 'max' => 11],
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
            'name' => '姓名',
            'age' => '年龄',
            'working_age' => '工龄',
            'headimg' => '头像',
            'phone' => '电话',
            'created_at' => '创建于',
        ];
    }
}
