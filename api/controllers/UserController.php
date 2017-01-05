<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;


use api\models\Order;
use api\models\Student;
use Yii;
use api\models\Msg;
use api\models\Patriarch;
use api\models\User;
use api\components\BaseController;

class UserController extends BaseController
{
    /*
     * 个人中心
     */
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
    /*
     * 我的服务
     */
    public function actionServe()
    {
        $patriarch = Patriarch::find()->where(['userid'=>Yii::$app->user->id])->one();

        $studentID = isset($patriarch->student_id) ? $patriarch->student_id : 0;

        $student = Student::find()->where(['id' => $studentID])->one();
        $order = Order::find()->where(['student_id' => $studentID])->one();
        //print_r($patriarch);
        return $this->render('serve', [
            'patriarch' => $patriarch,
            'student' => $student,
            'order' => $order,
        ]);
    }
    /*
     * 我的资料
     */
    public function actionView()
    {
        $model = User::find()->where(['id' => Yii::$app->user->id])->one();
        $patriarch = null;
        if($model->type = 'patriarch')
            $patriarch = Patriarch::find()->where(['userid'=>$model->id])->one();
        return $this->render('view', [
            'model' => $model,
            'patriarch' => $patriarch
        ]);
    }
    /*
     * 修改密码
     */
    public function actionPassword()
    {
        $model = User::findOne(Yii::$app->user->id);
        $dada = Yii::$app->request->post();
        if($dada)
        {
            $dada['User']['password_hash'] = Yii::$app->security->generatePasswordHash($dada['User']['password']);
            $dada['User']['auth_key'] = Yii::$app->security->generateRandomString();
            if ($model->load($dada) && $model->save())
                Yii::$app->session->setFlash('success', '保存成功！');
            else
                Yii::$app->session->setFlash('error', '保存失败！');
        }

        return $this->render('password',[
            'model' => $model
        ]);


    }
}