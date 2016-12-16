<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $openid
 * @property string $nickname
 * @property string $headimgurl
 * @property integer $sex
 * @property string $city
 * @property string $province
 * @property string $phone
 * @property integer $address
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $status
 * @property string $role
 * @property string $reg_ip
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['username', 'auth_key', 'password_hash', 'email', 'status', 'updated_at'], 'required'],
            [['sex', 'address', 'created_at', 'updated_at'], 'integer'],
            [['status', 'role'], 'string'],
            [['username', 'openid', 'nickname'], 'string', 'max' => 60],
            [['headimgurl'], 'string', 'max' => 250],
            [['city', 'province'], 'string', 'max' => 30],
            [['phone', 'reg_ip'], 'string', 'max' => 15],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash'], 'string', 'max' => 65],
            [['email'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'openid' => 'Openid',
            'nickname' => '昵称',
            'headimgurl' => '头像',
            'sex' => '性别',
            'city' => '城市',
            'province' => '省份',
            'phone' => '电话',
            'address' => 'Address',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'status' => 'Status',
            'role' => '用户角色',
            'reg_ip' => 'Reg Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
