<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;

use api\models\Msg;
use api\models\User;
use yii\web\Controller;

class UserController extends Controller
{
    /*
     * 用户中心
     */
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
    /*
     * 用户信息
     */
    public function actionView($id)
    {
        $model = User::find()->where(['id' => $id])->one();
        $this->render('view', [
            'model' => $model
        ]);
    }

    /*
     * 用户消息
     */
    public function actionMsg()
    {
        $model = Msg::find()->all();

        return $this->render('msg');
    }

    /*
     * 用户订单
     */
    public function actionOrders()
    {

    }
}