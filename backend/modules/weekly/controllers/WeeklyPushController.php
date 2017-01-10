<?php

namespace app\modules\weekly\controllers;

use Yii;
use app\modules\weekly\models\WeeklyPushLogs;
use app\modules\weekly\models\WeeklyPushLogsSearch;
use app\modules\weekly\models\Weekly;
use app\modules\weekly\models\WeeklySearch;
use app\components\CommonController;
use app\modules\student\models\Patriarch;
use yii\web\NotFoundHttpException;


class WeeklyPushController extends CommonController
{
    /**
     * Lists all WeeklyPushLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WeeklyPushLogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //推送周报时选择
    public function actionModalList()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['check1'=>1]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->renderAjax('modal-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //周报推送
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
        Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'推送成功！']);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = WeeklyPushLogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
