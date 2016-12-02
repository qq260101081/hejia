<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:22
 */

namespace frontend\controllers;


use frontend\models\Interesting;
use yii\web\Controller;
use yii\data\Pagination;

class InterestingController extends Controller
{
    public function actionIndex()
    {
        $data = Interesting::find()->orderBy('id desc');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize'=>4]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'model' => $model,
            'pages' => $pages
        ]);
    }

    public function actionView($id = 0)
    {
        $model = Interesting::find()->where(['id' => $id])->one();
        return $this->render('view',[
            'model' => $model
        ]);
    }
}