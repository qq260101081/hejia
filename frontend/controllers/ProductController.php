<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:22
 */

namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\ProductCategory;
use yii\web\Controller;
use yii\data\Pagination;

class ProductController extends Controller
{
    public function actionIndex($category_id = 0, $pid = 0)
    {
        $category = ProductCategory::find()->select(['id','name'])->where(['parent' => $category_id])->asArray()->all();
        if(!$pid) $pid = $category[0]['id'];

        $data = Product::find()->where(['category_id'=>$pid])->orderBy('id desc');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize'=>9]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'model' => $model,
            'category_id' => $category_id,
            'pages' => $pages,
            'category' => $category,
            'pid' => $pid
        ]);
    }

    public function actionView($id = 0,$category_id,$pid=0)
    {
        $category = ProductCategory::find()->select(['id','name'])->where(['parent'=>$category_id])->asArray()->all();

        $model = Product::find()->where(['id' => $id])->one();
        return $this->render('view',[
            'model' => $model,
            'category_id' => $category_id,
            'category' => $category,
            'pid' => $pid
        ]);
    }
}