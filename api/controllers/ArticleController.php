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
    public function actionView($type='about')
    {
        $model = Article::find()->where(['type' => $type])->one();
        return $this->render('view', [
            'model' => $model
        ]);
    }
}