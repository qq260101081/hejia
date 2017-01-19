<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:22
 */

namespace frontend\controllers;


use yii\web\Controller;

class ServiceController extends Controller
{
    public function actionProcess()
    {
        return $this->render('process');
    }
}