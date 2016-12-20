<?php

namespace app\modules\msg\controllers;


use Yii;
use app\modules\msg\models\WeeklyPushLogs;
use app\modules\msg\models\WeeklyPushLogsSearch;
use app\modules\student\models\Weekly;
use app\components\CommonController;
use app\modules\student\models\Patriarch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WeeklyPushLogsController implements the CRUD actions for WeeklyPushLogs model.
 */
class WeeklyPushLogsController extends CommonController
{
    /**
     * Lists all WeeklyPushLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WeeklyPushLogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/weekly-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WeeklyPushLogs model.
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
     * Creates a new WeeklyPushLogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WeeklyPushLogs();

        $selection = (array)Yii::$app->request->post('selection');

        if($selection)
        {
            $rows = [];
            $time = time();
            foreach($selection as $k => $id){
                $weekly = Weekly::findOne((int)$id);//make a typecasting
                $patriarch = Patriarch::find()->select(['userid','name'])->where(['student_id' => $weekly->student_id])->one();
                $rows[$k]['id'] = null;
                $rows[$k]['student_id'] = $weekly->student_id;
                $rows[$k]['student_name'] = $weekly->student_name;
                $rows[$k]['patriarch_id'] = $patriarch->userid;
                $rows[$k]['patriarch_name'] = $patriarch->name;
                $rows[$k]['discipline'] = $weekly->discipline;
                $rows[$k]['sleep'] = $weekly->sleep;
                $rows[$k]['diet'] = $weekly->diet;
                $rows[$k]['study'] = $weekly->study;
                $rows[$k]['synthesize'] = $weekly->synthesize;
                $rows[$k]['username'] = Yii::$app->user->identity->username;
                $rows[$k]['status'] = 0;
                $rows[$k]['created_at'] = $time;
            }
            Yii::$app->db->createCommand()->batchInsert(
                WeeklyPushLogs::tableName(),
                $model->attributes(),
                $rows
            )->execute();
        }

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing WeeklyPushLogs model.
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
            return $this->render('/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WeeklyPushLogs model.
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
     * Finds the WeeklyPushLogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WeeklyPushLogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WeeklyPushLogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
