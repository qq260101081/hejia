<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;

use api\models\Product;
use api\models\ProductCategory;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex($pid)
    {
        $category = ProductCategory::find()->select(['id','name'])->where(['id' => $pid])->one();

        $model = ProductCategory::find()->select(['id','name'])->where(['parent' => $pid])->all();

        return $this->render('index', [
            'model' => $model,
            'category' => $category
        ]);
    }

    public function actionList($pid)
    {
        $category = ProductCategory::find()->select(['id'])->where(['parent' => $pid])->indexBy('id')->asArray()->all();
        $model = Product::find()->where(['in','category_id',array_keys($category)])->orderBy('id desc')->all();

        return $this->render('list', [
            'model' => $model
        ]);
    }
}