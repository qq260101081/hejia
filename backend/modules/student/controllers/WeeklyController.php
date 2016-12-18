<?php

namespace app\modules\student\controllers;

use Yii;
use app\modules\student\models\Weekly;
use app\modules\student\models\WeeklySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WeeklyController implements the CRUD actions for Weekly model.
 */
class WeeklyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Weekly models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/weekly_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //推送周报时选择
    public function actionModalList()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('/weekly-modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Weekly model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/weekly_view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Weekly model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Weekly();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/weekly_create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Weekly model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/weekly_update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Weekly model.
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
     * Finds the Weekly model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Weekly the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Weekly::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
