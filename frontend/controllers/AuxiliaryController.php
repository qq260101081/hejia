<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/21 上午11:22
 */

namespace frontend\controllers;


use frontend\models\Auxiliary;
use frontend\models\ServiceCategory;
use yii\web\Controller;
use yii\data\Pagination;

class AuxiliaryController extends Controller
{
    public function actionIndex($category_id=0)
    {
        $categoryData = ServiceCategory::find()->indexBy('id')->asArray()->all();
        $category = $this->generateTree($categoryData);
        $data = Auxiliary::find()->orderBy('id desc');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize'=>4]);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        if(!$category_id)
        {
            foreach($category[4]['son'][137]['son'][140]['son'] as $v)
            {
                $category_id = $v['id'];
                break;
            }
        }
var_dump($category_id);
        return $this->render('index', [
            'category' => $category,
            'category_id' => $category_id,
            'model' => $model,
            'pages' => $pages
        ]);
    }

    public function actionView($id = 0)
    {
        $model = Auxiliary::findOne($id);
        return $this->render('view',[
            'model' => $model
        ]);
    }

    public function generateTree($items){
        foreach($items as $item)
            $items[$item['parent']]['son'][$item['id']] = &$items[$item['id']];
        return isset($items[0]['son']) ? $items[0]['son'] : array();
    }
}