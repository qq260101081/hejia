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

class AuxiliaryController extends Controller
{
    public function actionIndex($category_id=0)
    {
        $categoryData = ServiceCategory::find()->indexBy('id')->asArray()->all();
        $category = $this->generateTree($categoryData);
        if(!$category_id)
        {
            foreach($category[4]['son'][137]['son'][140]['son'] as $v)
            {
                $category_id = $v['id'];
                break;
            }
        }
        $data = Auxiliary::find()->where(['category_id'=>$category_id])->all();
        $model = [];
        foreach ($data as $v)
        {
            $model[$v->type][] = $v;
        }
        unset($category[4]['son'][137]['son'][151]);
        return $this->render('index', [
            'category' => $category,
            'category_id' => $category_id,
            'categoryData' => $categoryData,
            'model' => $model,
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