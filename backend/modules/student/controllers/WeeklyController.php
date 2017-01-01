<?php

namespace app\modules\student\controllers;


use app\modules\users\models\Users;
use Yii;
use app\modules\student\models\Weekly;
use app\modules\student\models\WeeklySearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;

/**
 * WeeklyController implements the CRUD actions for Weekly model.
 */
class WeeklyController extends CommonController
{

    /**
     * Lists all Weekly models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('/weekly_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //客服审核周报
    public function actionCustomerIndex()
    {
        $searchModel = new WeeklySearch();
        $data = Yii::$app->request->queryParams;

        $dataProvider = $searchModel->search($data);
        $dataProvider->query->andFilterWhere(['check1'=>0]);
        $dataProvider->query->andFilterWhere(['check2'=>1]);
        $dataProvider->query->andWhere(['remark'=>null]);


        return $this->render('/customer-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCustomerCheck($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(!$model->remark) $model->check1 = 1;
            $model->save();
            return $this->redirect(['customer-index']);
        } else {
            return $this->render('/customer-check', [
                'model' => $model,
            ]);
        }
    }
    //校长审核周报
    public function actionPresidentIndex()
    {
        $searchModel = new WeeklySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['check2'=>0]);
        $dataProvider->query->andWhere(['remark'=>null]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('/president-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPresidentCheck($id)
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
            $model->save();
            return $this->redirect(['president-index']);
        } else {
            return $this->render('/president-check', [
                'model' => $model,
            ]);
        }
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
        $model = $this->findModel($id);
        $user = Users::findOne($model->userid);
        $model->userid = $user->name;
        return $this->render('/weekly_view', [
            'model' => $model,
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

        if ($model->load(Yii::$app->request->post())) {
            $model->remark = NULL;
            $model->check1 = 0;
            $model->check2 = 0;
            $model->save();
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
