<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/22 上午10:12
 */
namespace frontend\models;
use Yii;

/**
 * This is the model class for table "{{%guestbook}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $phone
 * @property string $address
 * @property string $content
 * @property integer $created_at
 */
class Guestbook extends \yii\db\ActiveRecord
{
    public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guestbook}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'content'], 'required'],
            [['created_at'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 150],
            [['content'], 'string', 'max' => 500],
            ['verifyCode', 'captcha'],
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
            'username' => '留言人',
            'phone' => '联系电话',
            'address' => '所在地址',
            'content' => '留言内容',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}