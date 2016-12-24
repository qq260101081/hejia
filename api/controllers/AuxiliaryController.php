<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 * 托辅中心
 */

namespace api\controllers;

use api\models\Auxiliary;
use api\models\ServeCategory;
use yii\web\Controller;

class AuxiliaryController extends Controller
{
    //区域 校区选择
    public function actionArea()
    {
        $category = ServeCategory::find()->select(['id','name','parent'])->indexBy('id')->asArray()->all();
        $model = $this->generateTree($category);

        return $this->render('area', ['model' => $model]);
    }

    //校区介绍页
    public function actionIndex($pid = 0)
    {
        $res = Auxiliary::find()->where(['category_id' => $pid])->all();
        $model = [];
        foreach ($res as $v)
        {
            $model[$v->type][] = $v;
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
    //内容页面
    public function actionView($id)
    {
        $model = Auxiliary::find()->where(['id' => $id])->one();
        return $this->render('view', [
            'model' => $model
        ]);
    }

    //团队风采
    public function actionMien()
    {
        $model = Auxiliary::find()->select(['id','title','list_img'])->where(['type'=>1])->all();
        return $this->render('mien', [
            'model' => $model
        ]);
    }

    //分类树生成
    private function generateTree($items){
        foreach($items as $item)
            $items[$item['parent']]['son'][$item['id']] = &$items[$item['id']];
        return isset($items[0]['son']) ? $items[0]['son'] : array();
    }
}