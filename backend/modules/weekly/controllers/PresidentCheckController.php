<?php
/*
 * 周报审核（校长）
 * */
namespace app\modules\weekly\controllers;

use Yii;
use app\modules\weekly\models\Weekly;
use app\modules\weekly\models\WeeklySearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;


class PresidentCheckController extends CommonController
{
    //周报审核列表
    public function actionIndex()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['check2'=>0]);
        $dataProvider->query->andWhere(['remark'=>null]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //审核动作
    public function actionCheck($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->remark)
            {
                $model->check2 = 1;
            }
            else
            {
                $model->check1 = 0;
                $model->check2 = 0;
            }
            if($model->save())
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
