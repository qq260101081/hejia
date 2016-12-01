<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:22
 */

namespace frontend\controllers;


use frontend\models\NewsCategory;
use frontend\models\News;
use yii\web\Controller;
use yii\data\Pagination;

class NewsController extends Controller
{
    public function actionIndex($category_id = 0)
    {
        $category = NewsCategory::find()->select(['id','name'])->asArray()->all();
        if(!$category_id) $category_id = $category[0]['id'];

        $data = News::find()->where(['category_id'=>$category_id])->orderBy('id desc');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize'=>4]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'model' => $model,
            'category_id' => $category_id,
            'pages' => $pages,
            'category' => $category
        ]);
    }

    public function actionView($id = 0,$category_id)
    {
        $category = NewsCategory::find()->select(['id','name'])->asArray()->all();
        if(!$category_id) $category_id = $category[0]['id'];
        $model = News::find()->where(['id' => $id])->one();
        return $this->render('view',[
            'model' => $model,
            'category_id' => $category_id,
            'category' => $category
        ]);
    }
}