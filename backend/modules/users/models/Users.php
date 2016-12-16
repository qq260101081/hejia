<?php

namespace app\modules\users\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $type
 * @property string $telephone
 * @property string $website
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $status
 * @property string $ip
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public $password;
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['status'], 'string'],
            [['created_at', 'updated_at','sex'], 'integer'],
            [['username','nickname','openid'], 'string', 'max' => 60],
            [['phone', 'reg_ip'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 16],
            [['password'], 'string', 'min' => 6],
            [['auth_key','city','province'], 'string', 'max' => 32],
            [['password_hash'], 'string', 'max' => 65],
            ['headimgurl', 'string', 'max' => 250],
            [['email'], 'string', 'max' => 45],
            [['username','phone','email'], 'unique'],
            ['role','safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', '用户名'),
            'nickname' => Yii::t('app', '昵称'),
            'city' => Yii::t('app', '城市'),
            'province' => Yii::t('app', '省份'),
            'phone' => Yii::t('app', '电话'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'email' => Yii::t('app', '邮箱'),
            'status' => Yii::t('app', '状态'),
            'reg_ip' => Yii::t('app', '注册IP'),
            'password' => Yii::t('app', '密码'),
            'role' => Yii::t('app', '用户类型'),
            'created_at' => Yii::t('app', '创建于'),
            'updated_at' => Yii::t('app', '更新于'),
        ];
    }
}
