<?php

namespace app\modules\student\models;

use Yii;


/**
 * This is the model class for table "{{%user_patriarch}}".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $student_id
 * @property string $name
 * @property string $relation
 * @property string $phone
 * @property string $urgency_phone
 * @property string $urgency_person
 * @property string $address
 * @property string $remark
 */
class Patriarch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_patriarch}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'name', 'urgency_person','urgency_phone', 'relation', 'phone'], 'required'],
            [['student_id','category_id'], 'integer'],
            ['phone','number'],
            ['phone','string', 'min' =>11],
            ['phone','string', 'max' =>11],
            [['name', 'urgency_person'], 'string', 'max' => 12],
            [['relation'], 'string', 'max' => 18],
            [['phone', 'urgency_phone'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 90],
            [['remark'], 'string', 'max' => 600],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', '学生ID'),
            'name' => Yii::t('app', '姓名'),
            'relation' => Yii::t('app', '关系'),
            'phone' => Yii::t('app', '电话'),
            'urgency_phone' => Yii::t('app', '紧急联系电话'),
            'urgency_person' => Yii::t('app', '紧急联系人'),
            'address' => Yii::t('app', '地址'),
            'remark' => Yii::t('app', '备注'),
        ];
    }
}
