<?php

namespace app\modules\staff\models;

use Yii;

/**
 * This is the model class for table "{{%user_staff}}".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $name
 * @property integer $sex
 * @property integer $age
 * @property string $diploma
 * @property string $photo
 * @property integer $position
 * @property string $campus
 * @property string $phone
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password;

    public static function tableName()
    {
        return '{{%user_staff}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position', 'phone', 'category_id'], 'required'],
            [['userid', 'age','category_id'], 'integer'],
            [['name'], 'string', 'max' => 15],
            [['password'], 'string', 'min' => 6],
            [['password'], 'string', 'max' => 16],
            [['diploma','sex','position'], 'string', 'max' => 12],
            [['photo'], 'string', 'max' => 100],
            [['school'], 'string', 'max' => 90],
            [['phone'], 'string', 'max' => 11],
            [['phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', '用户表关联ID'),
            'name' => Yii::t('app', '姓名'),
            'sex' => Yii::t('app', '性别'),
            'age' => Yii::t('app', '年龄'),
            'category_id' => Yii::t('app', '所属校区'),
            'diploma' => Yii::t('app', '学历'),
            'photo' => Yii::t('app', '照片'),
            'position' => Yii::t('app', '岗位'),
            'password' => Yii::t('app', '登录密码'),
            'school' => Yii::t('app', '所属校区'),
            'phone' => Yii::t('app', '联系电话'),
        ];
    }
}
