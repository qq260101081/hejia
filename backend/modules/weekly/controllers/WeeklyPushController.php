<?php

namespace app\modules\weekly\controllers;


use Yii;
use app\modules\weekly\models\WeeklyPushLogs;
use app\modules\weekly\models\WeeklyPushLogsSearch;
use app\modules\weekly\models\Weekly;
use app\modules\weekly\models\WeeklySearch;
use app\components\CommonController;
use app\modules\student\models\Student;
use app\modules\users\models\Users;
use app\modules\student\models\Patriarch;
use common\models\MsgStatus;
use yii\web\NotFoundHttpException;
use \yii\web\UploadedFile;
use app\components\libs\Common;
use yii\helpers\BaseFileHelper;


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
        //客服已经审核通过的才显示
        $dataProvider->query->andWhere(['check1'=>1]);
        //未推送的才显示
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
        $postData = Yii::$app->request->post();
        if($model->load($postData))
        {
            $weekly = Weekly::findOne($postData['WeeklyPushLogs']['weekly_id']);
            $student = Student::findOne($weekly->student_id);
            if(!$student)
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'推送失败，该学生已不存在']);
                return $this->render('create', ['model' => $model]);
            }
            $patriarch = Users::findOne($student->patriarch_id);
            if(!$patriarch)
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'推送失败，该学生家长已不存在']);
                return $this->render('create', ['model' => $model]);
            }

            $imgs = [];
            $files = UploadedFile::getInstances($model, 'images');
            if($files){
                //创建文件夹
                $ymd = date("Ymd");
                $save_path = \Yii::getAlias('@upPath') . '/' . $ymd . "/";
                if(! file_exists($save_path))
                {
                    BaseFileHelper::createDirectory($save_path);
                }
                //遍历保存
                foreach ($files as $k => $file)
                {
                    // 新文件名
                    $newFile = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file->extension;
                    $file->saveAs($save_path . $newFile);
                    $imgs[$k]['extension'] = $file->extension;
                    $imgs[$k]['path'] = $ymd . '/' . $newFile;
                }
            }
            if(!$imgs)
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'推送失败，未能保存影像信息']);
                return $this->render('create', ['model' => $model]);
            }
            //赋值保存
            $model->student_id = $weekly->student_id;
            $model->student_name = $weekly->student_name;
            $model-> patriarch_id  = $patriarch->id;
            $model-> patriarch_name  = $patriarch->name;
            $model->discipline = $weekly->discipline;
            $model->sleep = $weekly->sleep;
            $model->diet = $weekly->diet;
            $model->study = $weekly->study;
            $model->synthesize  = $weekly->synthesize ;
            $model->stime  = $weekly->stime;
            $model->etime  = $weekly->etime;
            $model->created_at  = time();
            $model->username  = Yii::$app->user->identity->name;
            $model->images = json_encode($imgs);
            if($model->save()){
                //更新学生周报推送状态
                $weekly->status = 1;
                $weekly->save(false);
                //更新前端有最新消息的状态
                $msgStatus = MsgStatus::find()->where(['userid' => $patriarch->id])->one();
                if(!$msgStatus) {
                    $msgStatus = new MsgStatus();
                    $msgStatus->userid = $patriarch->id;
                }
                $msgStatus->status = 1;
                $msgStatus->save(false);

                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'推送成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'推送失败']);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
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
