<?php

namespace app\modules\product\controllers;


use Yii;
use app\modules\product\models\ProductCategory;
use app\components\CommonController;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends CommonController
{
public function actions() {
    return [
      	'nodeChildren' => [
        'class' => 'gilek\gtreetable\actions\NodeChildrenAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeCreate' => [
        'class' => 'gilek\gtreetable\actions\NodeCreateAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeUpdate' => [
        'class' => 'gilek\gtreetable\actions\NodeUpdateAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeDelete' => [
        'class' => 'gilek\gtreetable\actions\NodeDeleteAction',
        'treeModelName' => ProductCategory::className()
    ],
    'nodeMove' => [
        'class' => 'gilek\gtreetable\actions\NodeMoveAction',
        'treeModelName' => ProductCategory::className()
      ],
    ];
 }

	public function actionIndex() {
		return $this->render('@gilek/gtreetable/views/widget', [
			'options' => [
	        	'manyroots' => true,
	       		'draggable' => true,
    		],
			'columnName' => '产品分类管理',
            'title' => ''
		]);
  	}

  	public function actionGetNode($id) {
  	    if(!$id)
        {
            $categoryPath = ProductCategory::find()->where(['level' => 0])->indexBy('id')->asArray()->all();
        }
        else
        {
            $nodeInfo = ProductCategory::find()->where(['id' => $id])->asArray()->one();
            $categoryPath = ProductCategory::find()
                ->where(['level' => $nodeInfo['level'] + 1])
                ->andWhere(['root' => $nodeInfo['root']])
                ->andWhere(['>', 'lft', $nodeInfo['lft']])
                ->andWhere(['<', 'rgt', $nodeInfo['rgt']])
                ->orderBy('lft')
                ->indexBy('id')
                ->asArray()
                ->all();
        }
        echo json_encode($categoryPath);
  	}
}
