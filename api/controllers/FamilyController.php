<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 * 家庭服务
 */

namespace api\controllers;

use api\models\Family;
use yii\web\Controller;

class FamilyController extends Controller
{
    //家庭服务
    public function actionIndex()
    {
        $model = Family::find()->select(['id', 'title'])->where(['category_id'=>'138'])->all();
        return $this->render('index', ['model' => $model]);
    }

    public function actionView($id)
    {
        $model = Family::findOne($id);
        return $this->render('view', [
            'model' => $model
        ]);
    }
}