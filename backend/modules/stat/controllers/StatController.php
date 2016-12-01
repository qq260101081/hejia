<?php

namespace app\modules\stat\controllers;

class StatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
