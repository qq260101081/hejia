<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:22
 */

namespace frontend\controllers;

use frontend\models\Family;
use yii\web\Controller;

class FamilyController extends Controller
{
    public function actionIndex()
    {
        $model = Family::find()->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionView($id = 0)
    {
        $nenus = Family::find()->all();
        if(!$id)
        {
            foreach ($nenus as $v)
            {
                $id = $v->id;
                break;
            }
        }
        $model = Family::findOne($id);

        return $this->render('view',[
            'nenus' => $nenus,
            'model' => $model
        ]);
    }
}