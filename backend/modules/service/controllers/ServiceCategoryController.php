<?php

namespace app\modules\service\controllers;


use Yii;
use app\modules\service\models\ServiceCategory;
use app\components\CommonController;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ServiceCategoryController extends CommonController
{
    public function actions() {
        return [
            'nodeChildren' => [
            'class' => 'gilek\gtreetable\actions\NodeChildrenAction',
            'treeModelName' => ServiceCategory::className()
        ],
        'nodeCreate' => [
            'class' => 'gilek\gtreetable\actions\NodeCreateAction',
            'treeModelName' => ServiceCategory::className()
        ],
        'nodeUpdate' => [
            'class' => 'gilek\gtreetable\actions\NodeUpdateAction',
            'treeModelName' => ServiceCategory::className()
        ],
        'nodeDelete' => [
            'class' => 'gilek\gtreetable\actions\NodeDeleteAction',
            'treeModelName' => ServiceCategory::className()
        ],
        'nodeMove' => [
            'class' => 'gilek\gtreetable\actions\NodeMoveAction',
            'treeModelName' => ServiceCategory::className()
          ],
        ];
     }

	public function actionIndex() {

		return $this->render('@gilek/gtreetable/views/widget', [
			'options' => [
	        	'manyroots' => true,
	       		'draggable' => true,
    		],
			'columnName' => '和家服务栏目管理',
            'title' => ''
		]);
  	}


  	public function actionGetNode($id) {
  	    if(!$id)
        {
            $categoryPath = ServiceCategory::find()->where(['level' => 0])->indexBy('id')->asArray()->all();
        }
        else
        {
            $nodeInfo = ServiceCategory::find()->where(['id' => $id])->asArray()->one();
            $categoryPath = ServiceCategory::find()
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
