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
    //活动资讯列表
    public function actionIndex($category_id=0)
    {
        $model = Events::find()->select(['id', 'title', 'list_img', 'info'])->where(['category_id' => $category_id])->all();
        return $this->render('index', [
            'model' => $model,
            'category_id' => $category_id,
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