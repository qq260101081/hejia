<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;

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
        //获取家长信息
        $patriarch = Patriarch::find()->select(['id','student_id'])->where(['userid'=>Yii::$app->user->id])->one();
        $studentID = isset($patriarch->student_id) ? $patriarch->student_id : 0;

        $orders = Orders::find()->where(['student_id' => $studentID])->all();

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

        $patriarch = Patriarch::find()->where(['userid'=>Yii::$app->user->id])->one();
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