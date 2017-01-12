<?php

namespace app\modules\weekly\controllers;

use app\modules\student\models\Student;
use Yii;
use app\modules\weekly\models\WeeklyPushLogs;
use app\modules\weekly\models\WeeklyPushLogsSearch;
use app\modules\weekly\models\Weekly;
use app\modules\weekly\models\WeeklySearch;
use app\components\CommonController;
use app\modules\student\models\Patriarch;
use common\models\MsgStatus;
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
        $dataProvider->query->andWhere(['status'=>0]);
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
            $userids = [];
            $time = time();
            foreach($selection as $k => $id){
                $weekly = Weekly::findOne((int)$id);
                $student = Student::findOne($weekly->student_id);
                if(!$student) continue;
                $patriarch = Patriarch::find()->select(['id','name'])->where(['id' => $student->patriarch_id])->one();
                if(!$patriarch) continue;

                $userids[$patriarch->id] = $patriarch->id;
                //更新推送状态
                $weekly->status = 1;
                $weekly->save(false);

                $rows[$k]['id'] = null;
                $rows[$k]['student_id'] = $student->student_id;
                $rows[$k]['student_name'] = $student->student_name;
                $rows[$k]['patriarch_id'] = $patriarch->id;
                $rows[$k]['patriarch_name'] = $patriarch->name;
                $rows[$k]['discipline'] = $weekly->discipline;
                $rows[$k]['sleep'] = $weekly->sleep;
                $rows[$k]['diet'] = $weekly->diet;
                $rows[$k]['study'] = $weekly->study;
                $rows[$k]['synthesize'] = $weekly->synthesize;
                $rows[$k]['username'] = Yii::$app->user->identity->name;
                $rows[$k]['status'] = 0;
                $rows[$k]['stime'] = $weekly->stime;
                $rows[$k]['etime'] = $weekly->etime;
                $rows[$k]['created_at'] = $time;
            }
            Yii::$app->db->createCommand()->batchInsert(
                WeeklyPushLogs::tableName(),
                $model->attributes(),
                $rows
            )->execute();
            foreach ($userids as $v)
            {
                $msgStatus = MsgStatus::find()->where(['userid' => $v])->one();
                if(!$msgStatus) {
                    $msgStatus = new MsgStatus();
                    $msgStatus->userid = $v;
                }
                $msgStatus->status = 1;
                $msgStatus->save(false);
            }
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
