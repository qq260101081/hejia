<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:22
 */

namespace frontend\controllers;


use frontend\models\Events;
use frontend\models\EventsCategory;
use yii\web\Controller;
use yii\data\Pagination;

class EventsController extends Controller
{
    public function actionIndex($category_id = 0)
    {
        $category = EventsCategory::find()->all();
        if(!$category_id)
        {
            foreach ($category as $v)
            {
                $category_id = $v->id;
                break;
            }
        }
        $data = Events::find()->where(['category_id' => $category_id])->orderBy('id desc');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize'=>4]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'model' => $model,
            'category' => $category,
            'category_id' => $category_id,
            'pages' => $pages
        ]);
    }

    public function actionView($id = 0,$category_id = 0)
    {
        $category = EventsCategory::find()->all();
        $model = Events::find()->where(['id' => $id])->one();
        return $this->render('view',[
            'model' => $model,
            'category' => $category,
            'category_id' => $category_id,
        ]);
    }
}