<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/3 下午12:21
 */
namespace api\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $password;
    public $repassword;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            //[['username'], 'match', 'pattern'=>'/^\w{6,20}$/', 'message'=>'{attribute}为6-20位数字字母或下划线'],
            [['password','repassword'],'required'],
            [['password','repassword'], 'string', 'min'=>6],
            [['password','repassword'], 'string', 'max'=>16],
            ['password', 'match', 'pattern'=>'/^[\@A-Za-z0-9\!\#\%\^\,\*\.\~]{6,18}$/','message'=>'密码必须数字或字母开头，可以用户字符!#~^,.'],
            ['repassword','compare','compareAttribute'=>'password','message'=>'两次密码不一致'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'repassword' => '重复密码',
        ];
    }

}