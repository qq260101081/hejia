<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 * 活动资讯
 */

namespace api\controllers;

use api\models\Events;
use yii\web\Controller;

class EventsController extends Controller
{
    //最新活动
    public function actionActivity()
    {
        $model = Events::find()->select(['id', 'title', 'list_img', 'info'])->where(['category_id' => '146'])->all();
        return $this->render('activity', [
            'model' => $model,
        ]);
    }



    public function actionView($id)
    {
        $model = Events::find()->where(['id' => $id])->one();
        return $this->render('view', [
            'model' => $model
        ]);
    }
}