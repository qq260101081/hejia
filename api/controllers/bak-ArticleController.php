<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;

use api\models\Article;
use yii\web\Controller;

class ArticleController extends Controller
{
    public function actionIndex($type = 0)
    {
        $model = Article::find()->where(['type' => $type])->all();
        return $this->render('index', [
            'model' => $model,
            'type' => $type
        ]);
    }

    public function actionView($id)
    {
        $model = Article::find()->where(['id' => $id])->one();
        $this->render('view', [
            'model' => $model
        ]);
    }
}