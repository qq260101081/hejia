<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/15 下午12:33
 */

namespace app\modules\orders\models;

use app\modules\staff\models\Staff;
use backend\modules\service\models\ServiceCategory;
use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $student_name
 * @property integer $product_id
 * @property string $product_name
 * @property integer $stime
 * @property integer $etime
 * @property string $money
 * @property string $payment_type
 * @property string $principal
 * @property string $remark
 * @property integer $created_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $teacher_name;
    public static function tableName()
    {
        return '{{%orders}}';
    }

    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'teacher_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(ServiceCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id','student_name','product_name','product_id','stime','etime'], 'required'],
            [['student_id', 'product_id','teacher_id', 'category_id','created_at'], 'integer'],
            [['money'], 'number'],
            [['student_name', 'principal','teacher_name'], 'string', 'max' => 12],
            [['product_name'], 'string', 'max' => 90],
            [['payment_type'], 'string', 'max' => 9],
            [['remark'], 'string', 'max' => 300],
            ['created_at', 'default', 'value' => time()]
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
            'teacher_id' => Yii::t('app', '服务人员'),
            'student_name' => Yii::t('app', '学生'),
            'product_id' => Yii::t('app', '服务项目ID'),
            'product_name' => Yii::t('app', '服务项目'),
            'patriarch_name' => Yii::t('app', '客户姓名'),
            'phone' => Yii::t('app', '客户电话'),
            'teacher_name' => Yii::t('app', '服务人员'),

            'stime' => Yii::t('app', '开始日期'),
            'etime' => Yii::t('app', '结束日期'),
            'money' => Yii::t('app', '金额'),
            'payment_type' => Yii::t('app', '支付方式'),
            'principal' => Yii::t('app', '操作员'),
            'remark' => Yii::t('app', '备注'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
