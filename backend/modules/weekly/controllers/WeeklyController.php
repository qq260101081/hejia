<?php

namespace app\modules\weekly\controllers;

use Yii;
use app\modules\weekly\models\Weekly;
use app\modules\student\models\Patriarch;
use app\modules\weekly\models\WeeklySearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;

/**
 * WeeklyController implements the CRUD actions for Weekly model.
 */
class WeeklyController extends CommonController
{
    //周报列表
    public function actionIndex()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //周报查看
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $patriarch = Patriarch::find()->select(['name','id'])->where(['student_id'=>$model->student_id])->one();

        $model->userid = $patriarch->name;
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    //周报创建
    public function actionCreate()
    {
        $model = new Weekly();
        $data = Yii::$app->request->post();
        if ($model->load($data)) {
            $model->stime = strtotime($model->stime);
            $model->etime = strtotime($model->etime);
            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'创建成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'创建失败！']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    //周报更新
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->stime = date('Y-m-d',$model->stime);
        $model->etime = date('Y-m-d',$model->etime);
        if ($model->load(Yii::$app->request->post())) {
            $model->remark = NULL;
            $model->check1 = 0;
            $model->check2 = 0;
            $model->stime = strtotime($model->stime);
            $model->etime = strtotime($model->etime);
            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    //周报删除
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    //周报导出
    public function actionExport()
    {
        //print_r($params);die;
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'Weekly' => [
                    'class' => 'codemix\excelexport\ActiveExcelSheet',
                    'query' => $dataProvider->query,
                ]
            ]
        ]);
        $file->send('学生周报.xlsx');
    }

    protected function findModel($id)
    {
        if (($model = Weekly::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
