<?php
/*
 * 周报审核（客服）
 * */
namespace app\modules\weekly\controllers;

use Yii;
use app\modules\weekly\models\Weekly;
use app\modules\weekly\models\WeeklySearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;


class CustomerCheckController extends CommonController
{
    //周报列表
    public function actionIndex()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['check1'=>0]);
        $dataProvider->query->andFilterWhere(['check2'=>1]);
        $dataProvider->query->andWhere(['remark'=>null]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //审核动作
    public function actionCheck($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if($data)
        {
            if($data['check']){
                $model->check1 = 1;
            }
            else
            {
                $model->check1 = 0;
                $model->check2 = 0;
                $model->remark = $data['remark'];
            }
            if($model->save(false))
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'审核成功！']);
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'审核失败！']);
        }
        return $this->render('check', [
            'model' => $model,
        ]);
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
