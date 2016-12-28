<?php

namespace app\modules\service\controllers;


use Yii;
use backend\modules\service\models\Family;
use backend\modules\service\models\FamilySearch;
use backend\modules\service\models\ServiceCategory;
use app\components\CommonController;
use yii\web\NotFoundHttpException;

/**
 * MenusController implements the CRUD actions for Menus model.
 */
class FamilyController extends CommonController
{

    public function actions()
    {
    	return [
    		'upload' => ['class' => 'kucha\ueditor\UEditorAction'],
    		'config' => [
    		    'lang' => 'zh-cn',
                'imageUrlPrefix' => Yii::$app->params['imageUrlPrefix'],
                //'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}"
    		]
    	];
    }
    /**
     * Lists all Menus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FamilySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $category = ServiceCategory::find()->select(['id','name'])->asArray()->all();

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }


    /**
     * Displays a single Menus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Family::find()->with('categoryName')->where(['id' => $id])->one();
       // print_r($model);die;
        //$category = ServiceCategory::find()->select(['id','name'])->indexBy('id')->asArray()->all();
        //$model = $this->findModel($id);

        return $this->render('/view', [
            'model' => $model,
            //'category' => $category
        ]);
    }

    /**
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Family();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryInfo = ServiceCategory::find()->where(['id'=>$model->category_id])->asArray()->one();
        $categoryPath = ServiceCategory::find()
            ->where(['<','lft',$categoryInfo['lft']])
            ->andWhere(['>','rgt',$categoryInfo['rgt']])
            ->andWhere(['root' => $categoryInfo['root']])
            ->orderBy('lft')
            ->indexBy('id')
            ->asArray()
            ->all();

        $categoryPath[$categoryInfo['id']] = $categoryInfo;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/update', [
                'model' => $model,
                'categoryPath' => $categoryPath
            ]);
        }
    }

    /**
     * Deletes an existing Menus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Family::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
