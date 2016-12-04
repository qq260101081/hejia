<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;

use app\modules\product\models\Product;
use yii\web\Controller;

class ProductController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $model = Product::find()->orderBy('id desc')->all();
        return $this->render('index', [
            'model' => $model
        ]);
    }
}