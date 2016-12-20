<?php

namespace app\modules\orders\controllers;


use Yii;
use app\modules\orders\models\Orders;
use app\modules\orders\models\OrdersSearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends CommonController
{

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            $model->principal = Yii::$app->user->identity->username;
            $model->stime = strtotime($data['Orders']['stime']);
            $model->etime = strtotime($data['Orders']['etime']);
            //print_r($model);die;
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            print_r($model->getErrors());die;

        } else {
            return $this->render('/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->stime = date('Y-m-d', $model->stime);
        $model->etime = date('Y-m-d', $model->etime);
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            $model->principal = Yii::$app->user->identity->username;
            $model->stime = strtotime($data['Orders']['stime']);
            $model->etime = strtotime($data['Orders']['etime']);
            //print_r($data);
            //print_r($model);die;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
