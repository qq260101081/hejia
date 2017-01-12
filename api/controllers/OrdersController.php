<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;

use Yii;
use api\components\BaseController;
use api\models\Orders;
use api\models\Patriarch;
use api\models\Staff;
use api\models\Student;

class OrdersController extends BaseController
{
    /*
     * 我的服务
     */
    public function actionIndex()
    {
        $studentids = [];
        $orders = [];
        $students = Student::find()->select(['id','name'])->where(['patriarch_id' => Yii::$app->user->id])->all();
        foreach ($students as $v)
        {
            $studentids[$v->id] = $v->id;
        }

        if($studentids)
            $orders = Orders::find()->where(['in', 'student_id', $studentids])->all();

        return $this->render('index', [
            'orders' => $orders
        ]);
    }
    /*
     * 我的服务详情
     */
    public function actionView($id)
    {
        $order = Orders::findOne($id);

        $patriarch = Patriarch::find()->where(['id'=>Yii::$app->user->id])->one();
        $student = Student::find()->where(['id' => $order->student_id])->one();
        $staff = Staff::findOne($order->teacher_id);

        return $this->render('serve', [
            'patriarch' => $patriarch,
            'student' => $student,
            'staff' => $staff,
            'order' => $order,
        ]);
    }

}